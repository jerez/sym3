<?php
Prado::using('System.Security.TAuthManager');
/**
 * Clase Sym3UserAuthManager.
 * 
 * @author Carlos Eduardo Jerez Paz
 * @link http://www.quider.net/
 * @copyright Copyright &copy; 2003 Quider
 * @package SYM3
 */
class Sym3AuthManager extends TAuthManager {

	// campo privado que contiene el tiempo de inactividad en segundos
	private $_authExpire=300;

	/**
	 * Propiedad que contiene el tiempo de inactividad en segundos
	 * para considerar que la sesion debe darse por expirada
	 * Setter
	 *
	 * @param unknown_type $authExpire
	 */
	public function setAuthExpire($authExpire){
		$this->_authExpire=$authExpire;
	}

	/**
	 * Propiedad que contiene el tiempo de inactividad en segundos
	 * para considerar que la sesion debe darse por expirada
	 * Getter
	 *
	 * @param unknown_type $authExpire
	 */
	public function getAuthExpire(){
		return $this->_authExpire;
	}

	/**
	 * Override de Lopin
	 *
	 * @param string $login
	 * @param string $password
	 * @return boolean
	 */
	public function login($login,$password){

		//Si no se ha creado o si el usuario es el mismo:: (Bug si se refresca la pagina depues de loguearse)
		if (Prado::getApplication()->User->Id!==null && Prado::getApplication()->User->Name!==$login) {

			$UserManager = $this->getUserManager();
			if ($UserManager->validateUser($login,$password)){
				$user=$UserManager->getUser($login);
				if (!$user->IsGuest){
					$user->Time = time();
				}
				$this->updateSessionUser($user);
				$this->getApplication()->setUser($user);
				return true;
			}else{
				return false;
			}
		}
	}

	/**
	 * Override de OnAuthenticate
	 *
	 */
	public function OnAuthenticate($param){
		parent::OnAuthenticate($param);
		if (!$this->Application->User->IsGuest){
			if (($this->Application->User->Time + $this->AuthExpire) < time()){
				$this->logout();
				$this->Response->redirect($this->Service->constructUrl($this->LoginPage));
			}
			else{
				$this->Application->User->Time = time();
				$this->updateSessionUser($this->Application->User);
			}
		}
	}

	/**
	 * Override OnAuthorize
	 *
	 * @param unknown_type $param
	 */
	public function OnAuthorize($param){

		$page = $this->Application->Service->RequestedPagePath;
		$idUsuario = $this->Application->User->Id;
		if (isset($page) && isset($idUsuario)) {
			$db = $this->Application->Modules['db']->Database;
			$db->Active = true;
			$sql ="select sys_seg_recursos_id
			from sys_seg_usuarios_has_recursos_view 
			where sys_seg_usuarios_id=".TPropertyValue::ensureInteger($idUsuario)." 
			and identificador_recurso='".TPropertyValue::ensureString($page)."'";

			$cmd = $db->createCommand($sql);

			if(!TPropertyValue::ensureBoolean($cmd->queryScalar())){
				$this->DenyRequest();
			}
			$db->Active = false;
		}else{
			parent::onAuthorize($param);
		}

	}
	
	private function DenyRequest(){
		$this->Application->getResponse()->setStatusCode(401);
		$this->Application->completeRequest();
	}
	
}
?>