<?php

/**
 * Clase StatusControl.
 * 
 * @author Carlos Eduardo Jerez Paz
 * @link http://www.quider.net/
 * @copyright Copyright &copy; 2009 Quider
 * @version $Id: StatusControl.php Fri Jan 30 23:01:37 COT 2009 Carlos Eduardo 
 * @package SYM3
 */
class StatusControl extends TTemplateControl {

	/**
	 * Constructor === __construct
	 * descripcion_ctor
	 *
	 * @return StatusControl
	 */
	public function StatusControl(){
		parent::__construct();
	}

	function onLoad($param){
		parent::onLoad($param);

		$this->NombreUsuario->Text = $this->Application->User->NombreCompleto;
	}

	public function logout($sender,$param){
		$this->Application->getModule('auth')->logout();
		$this->Response->redirect($this->Service->constructUrl('Home'));
	}

}

?>