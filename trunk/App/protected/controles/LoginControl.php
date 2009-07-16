<?php

/**
 * Clase LoginControl.
 * 
 * @author Carlos Eduardo Jerez Paz
 * @link http://www.quider.net/
 * @copyright Copyright &copy; 2009 Quider
 * @version $Id: LoginControl.php Fri Jan 30 22:19:46 COT 2009 Carlos Eduardo 
 * @package SYM3
 */
class LoginControl extends TTemplateControl{
	
	/**
	 * Handler para el boton ingresar
	 * Usa @see SYM3AuthManager pñara determinar si es un usuario valido en el sistema
	 *
	 * @param TControl $sender
	 * @param TParam $param
	 */
	public function validateUser($sender,$param)
	{
		$authManager=$this->Application->getModule('auth');
		if(!$authManager->login($this->Username->Text,md5($this->Password->Text)))
			$param->IsValid=false;

		else $this->Response->redirect($this->Service->constructUrl('Test'));

	}
	
}

?>