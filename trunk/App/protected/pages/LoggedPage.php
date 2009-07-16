<?php

/**
 * Clase LoggedPage.
 * 
 * @author Carlos Eduardo Jerez Paz
 * @link http://www.quider.net/
 * @copyright Copyright &copy; 2009 Quider
 * @version $Id: LoggedPage.php Wed Feb 04 10:49:53 COT 2009 Carlos Eduardo 
 * @package SYM3 Pages
 */
class LoggedPage extends TPage {

	private $_userId;
	private $_moduloId;
	private $_subModuloId;
	private $_funcionId;

	/**
	 * Constructor === __construct
	 * Pagina para el manejo adecuado de redirecciones y caraga de paginas en el sistema
	 *
	 * @return LoggedPage
	 */
	public function LoggedPage(){
		parent::__construct();
	}

	/**
	 * Override de OnInit
	 *
	 * @param unknown_type $param
	 */
	public function onPreInit($param){
		parent::onPreInit($param);

		$this->_subModuloId = TPropertyValue::ensureInteger($this->Request['submodulo_id']);
		$this->_funcionId = TPropertyValue::ensureInteger($this->Request['funcion_id']);
		$this->_userId = TPropertyValue::ensureInteger($this->Application->User->Id);
		$this->ObtenerModuloId();

		$this->RedireccionarPeticion();
	}

	/**
	 * Redirecciona la peticion a la pagina por defecto de la función solicitada
	 *
	 */
	protected function RedireccionarPeticion(){

		$identificador_recurso = $this->BuscarRecursoPrincipal();
		if (isset($identificador_recurso )) {
			$this->Response->Redirect($this->Service->ConstructUrl($identificador_recurso,array('modulo_id'=>$this->_moduloId)));
		}else{
			$this->Response->Redirect($this->Service->ConstructUrl($identificador_recurso,array('modulo_id'=>$this->_moduloId,'mensaje_id'=>Mensajes::Singleton()->SinRecurso->getId())));
		}
	}


	/**
	 * Obtiene el recurso principal de la funcion requerida
	 *
	 * @return string identificador del recurso => (modulo.pagina)
	 */
	protected function BuscarRecursoPrincipal(){
		$db = $this->Application->Modules['db']->Database;
		$db->Active = true;
		$sql ="select identificador_recurso
					from sys_seg_usuarios_has_recursos_view 
					where sys_seg_usuarios_id=".$this->_userId."
						and sys_seg_funciones_id=".$this->_funcionId."
					order by es_principal desc,sys_seg_recursos_id asc limit 1";
		$row = $db->createCommand($sql)->queryRow();
		$db->Active = false;

		$identificador_recurso= $row['identificador_recurso'];

		return $identificador_recurso;
	}

	/**
	 * Asigna a el campo privado _moduloId el valor apropiado
	 *
	 */
	protected function ObtenerModuloId(){
		$db = $this->Application->Modules['db']->Database;
		$db->Active = true;
		$sql ="select sys_seg_modulos_id
					from sys_seg_submodulos 
					where sys_seg_submodulos_id=".$this->_subModuloId;

		$row = $db->createCommand($sql)->queryRow();
		$db->Active = false;

		$this->_moduloId= $row['sys_seg_modulos_id'];
	}
}

?>