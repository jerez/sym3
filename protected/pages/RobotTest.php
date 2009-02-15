<?php

class Test extends TPage
{
	public function OnAbrirPinzaClicked($sender,$param)
	{
		$this->EjecutarComando(array("1;1;EXECHOPEN 1"));
	}

	public function OnCerrarPinzaClicked($sender,$param)
	{
		$this->EjecutarComando(array("1;1;EXECHCLOSE 1"));
	}
	
	public function OnEjecutarProgramaClicked($sender,$param)
	{
		$this->EjecutarComando(array("1;1;STEPR"));
	}

	public function OnWaistIzqClicked($sender,$param)
	{

		$waist = array("1;1;EXECJOVRD 50.0","1;1;EXECJSYM3 = (-5.000, 0.000,0.000, 0.000, 0.000, 0.000)","1;1;EXECMOV J_CURR + JSYM3");
		$this->EjecutarComando($waist);
	}

	public function OnWaistDerClicked($sender,$param)
	{
		$waist = array("1;1;EXECJOVRD 50.0","1;1;EXECJSYM3 = (5.000, 0.000, 0.000, 0.000, 0.000, 0.000)","1;1;EXECMOV J_CURR + JSYM3");
		$this->EjecutarComando($waist);
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

		//Abrimos la conexión
		$Conexion = fsockopen("192.168.0.1","10001");

		$array_comandos = array_merge($array_comandos,$comandos);
		//Se adiciona el ultimo comando
		$array_comandos = array_merge($array_comandos,$finalizar_comandos);

		print_r($array_comandos);
		foreach ($array_comandos as $comando) {
			//Le ponemos el comando al socket
			if(!fputs($Conexion,$comando."\r\n"))
			{
				throw new THttpException(999,"Error de socket, no se pudo escribir");
			}
			//Se hace esto para lograr una comunicación unidireccional
			//lo óptimo es manejar comunicación bidireccinal, para ello no se hace el sleep,
			//se lee el buffer del socket.
			//TODO: implementar comunicación Bidireccional
			usleep(8000);
		}
	}

}

?>