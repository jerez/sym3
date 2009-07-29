<?php

class ControlOnline extends TPage
{
	//private $_controladorMelfa;
	private $_configuracion;


	public function onLoad($param)
	{
		parent::onLoad($param);
		$this->_configuracion = MelfaRecord::finder()->findByPk(1);
		if(!$this->IsPostBack)
		{
			$data=array('Waist','Shoulder','Elbow','Twist','Pitch','Roll');
			$this->DBRadioButtonList2->DataSource=$data;
			$this->DBRadioButtonList2->dataBind();
		}
	}


	public function OnAbrirPinzaClicked($sender,$param)
	{
		$this->AbrirPinza();
	}

	public function OnCerrarPinzaClicked($sender,$param)
	{
		$this->CerrarPinza();
	}

	public function OnEjecutarProgramaClicked($sender,$param)
	{
		$this->EjecutarPrograma();
	}

	public function OnDetenerClicked($sender,$param)
	{
		$this->DetenerPrograma();
	}

	public function OnNegClicked($sender,$param)
	{
		$this->MoverArticulacion($this->ObtenerArticulacionSeleccionada(),false);
	}

	public function OnPosClicked($sender,$param)
	{
		$this->MoverArticulacion($this->ObtenerArticulacionSeleccionada());
	}

	private function ObtenerArticulacionSeleccionada()
	{
		$indices = $this->DBRadioButtonList2->SelectedIndices;
		//solo se selecciona un valor
		$item = $this->DBRadioButtonList2->Items[$indices[0]];
		return  $item->Value;
	}
	
	
	/**
	 * pARTE DEL CONTROLADOR
	 */
	
	public function AbrirPinza()
	{
		$this->EjecutarComando(array("1;1;EXECHOPEN 1"));
	}

	public function CerrarPinza()
	{
		$this->EjecutarComando(array("1;1;EXECHCLOSE 1"));
	}

	public function EjecutarPrograma()
	{
		//Ejecuta el prgrama cargado en el slot 1
		$this->EjecutarComando(array("1;1;RUN"));
	}
	public function DetenerPrograma()
	{
		//Detiene la ejecucion
		$this->EjecutarComando(array("1;0;STOP"));
	}
	public function MoverArticulacion($articulacion=0,$valorPositivo=true)
	{
		$comando = $this->GenerarComandoPosiciones($articulacion,$valorPositivo);
		$this->EjecutarComando($comando);
	}
	private function EjecutarComando($comandos=array())
	{
		if (!is_array($comandos))throw new THttpException(998,"Los comandos deben estar contenidos en un arreglo");
		/**
		 * se definen los comandos comunes
		 */

		$array_comandos = array(
		"1;1;RSTALRM",
		"1;1;STATE",
		"1;1;CNTLON");

		//Este el el ultimo comando que se debe enviar siempre
		$finalizar_comandos = array("1;1;CNTLOFF");

		$array_comandos = array_merge($array_comandos,$comandos);
		//Se adiciona el ultimo comando
		$array_comandos = array_merge($array_comandos,$finalizar_comandos);

		//Abrimos la conexión
		$socket = fsockopen($this->_configuracion->direccion_ip,$this->_configuracion->puerto);

		foreach ($array_comandos as $comando) {
			//Le ponemos el comando al socket
			if(!fputs($socket,$comando."\r\n"))
			{
				throw new THttpException(999,"Error de socket, no se pudo escribir");
			}
			//Se hace esto para lograr una comunicación unidireccional
			//lo óptimo es manejar comunicación bidireccinal, para ello no se hace el sleep,
			//se lee el buffer del socket.
			//TODO: implementar comunicación Bidireccional
			usleep($this->_configuracion->timeout);
		}
		fclose($socket);

		//      $socket = $this->conectar("192.168.0.1","10001");
		//		foreach ($array_comandos as $comando) {
		//			if(!$this->escribir($socket,$comando))
		//			{
		//				throw new THttpException(999,"Error de socket, no se pudo escribir");
		//			}
		//			print_r($this->leer($socket));
		//
		//		}

	}

	private function GenerarComandoPosiciones($articulacion=0,$valorPositivo=true)
	{
		$arrayPosiciones = array('0.000','0.000','0.000','0.000','0.000','0.000');
		$arrayPosiciones[$articulacion] =  $valorPositivo? "{$this->_configuracion->desplazamiento}.000":"-{$this->_configuracion->desplazamiento}.000";
		$stringPosiciones = implode(', ',$arrayPosiciones);
		return array("1;1;EXECJOVRD {$this->_configuracion->velocidad}.0","1;1;EXECJSYM3 = ($stringPosiciones)","1;1;EXECMOV J_CURR + JSYM3");
	}

	

}

?>