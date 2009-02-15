<?php

/**
 * Clase Usuario.
 * 
 * @author Carlos Eduardo Jerez Paz
 * @link http://www.quider.net/
 * @copyright Copyright &copy; 2008 Quider
 * @version $Id: Usuario.php Thu Oct 30 11:37:15 COT 2009 Carlos Eduardo 
 * @package SYM3
 */
class Usuario extends TDbUser {

	/**
	 * Propiedad que almacena el Id del usuario
	 * Setter
	 * 
	 * @param int $value
	 */
	public function setId($value){
		$this->setState('Id',$value,'');
	}
	/**
	 * Propiedad que almacena el Id del usuario
	 * Getter
	 * 
	 * @param int $value
	 */
	public function getId(){
		return $this->getState('Id','');
	}

	/**
	 * Propiedad que almacena el nombre completo del usuario
	 * Setter
	 * 
	 * @param unknown_type $value
	 */
	public function setNombreCompleto($value){
		$this->setState('NombreCompleto',$value,'');
	}
	/**
	 * Propiedad que almacena el nombre completo del usuario
	 * Getter
	 * 
	 * @param unknown_type $value
	 */
	public function getNombreCompleto(){
		return $this->getState('NombreCompleto','');
	}

	/**
	 * Propiedad que almacena el Estado
	 * Activo/Inactivo/Suspendido
	 * Setter
	 *
	 * @param unknown_type $value
	 */
	public function setEstado($value){
		$this->setState('Estado',$value,'');
	}
	/**
	 * Propiedad que almacena el Estado
	 * Activo/Inactivo/Suspendido
	 * Setter
	 *
	 * @param unknown_type $value
	 */
	public function getEstado(){
		return $this->getState('Estado','');
	}

	/**
	 * Propiedad que almacena el Email
	 * Setter
	 * 
	 * @param unknown_type $value
	 */
	public function setEmail($value){
		$this->setState('Email',$value,'');
	}
	/**
	 * Propiedad que almacena el Email
	 * Getter
	 * 
	 * @param unknown_type $value
	 */
	public function getEmail(){
		return $this->getState('Email','');
	}

	/**
	 * Propiedad que almacena un timestamp, 
	 * para determinar si el usuario a tenido actividad
	 * Setter
	 * @param timestamp $value
	 */
	public function setTime($value){
		$this->setState('Time',$value,'');
	}
	/**
	 * Propiedad que almacena un timestamp, 
	 * para determinar si el usuario a tenido actividad
	 * Getter
	 * @param timestamp $value
	 */
	public function getTime(){
		return $this->getState('Time','');
	}

	/**
	 * Propiedad que almacena la fecha y hora de el ultimo ingreso
	 * Setter
	 * 
	 * @param unknown_type $value
	 */
	public function setLastLogin($value){
		$this->setState('LastLogin',$value,'');
	}
	/**
	 * Propiedad que almacena la fecha y hora de el ultimo ingreso
	 * Getter
	 * 
	 * @param unknown_type $value
	 */
	public function getLastLogin(){
		return $this->getState('LastLogin','');
	}

	/**
	 * metodo fabrica que retorna una instancia de esta clase 
	 * a partir del nombre de usuario
	 *
	 * @param unknown_type $login
	 * @return unknown
	 */
	public function createUser($login){
		// usa AdminRecord Active Record para buscar el nombre de usuario especificado
		$userRecord=UserRecord::finder()->findByLogin($login);
		$usuario= Usuario::ConstructorComun($userRecord);

		if ($usuario!==null ){
			// el usuario no es visitante
			$usuario->IsGuest=false;
			//Actualiza el ultimo ingtreso del usuario
			$userRecord->last_login=FechasMysql::MySqlTimeStamp();
			$userRecord->save();
		}
		return $usuario;
	}

	/**
	 * metodo fabrica que retorna una instancia de esta clase 
	 * a partir del nombre de usuario
	 *
	 * @param string $login
	 * @return Usuario
	 */
	public static function CreateUserByLogin($login){
		// usa AdminRecord Active Record para buscar el nombre de usuario especificado
		$userRecord=UserRecord::finder()->findByLogin($login);
		return $usuario= Usuario::ConstructorComun($userRecord);
	}

	/**
	 * Metodo fabrica que retorna una instancia de esta clase a partir del id de usuario
	 *
	 * @param unknown_type $id
	 * @return unknown
	 */
	public static function CreateUserById($id){
		// usa UserRecord Active Record para buscar el id de usuario especificado
		$userRecord=UserRecord::finder()->findByPk($id);
		return Usuario::ConstructorComun($userRecord);
	}

	/**
	 * Construye una instancia de esta clase a partir de 
	 * una instancia de la Clase UserRecord
	 *
	 * @param UserRecord $userRecord
	 * @return Usuario
	 */
	private static function ConstructorComun($userRecord)
	{
		if($userRecord!==null && $userRecord instanceof UserRecord) // Si existe
		{
			$user = new Usuario(Prado::getApplication()->getModule('users'));//se crea una instancia con el constructor de la base
			$user->Name = $userRecord->login; // set Name=Login
			$user->Id = $userRecord->sys_seg_usuarios_id; // set Id
			$user->NombreCompleto = $userRecord->nombres.' '.$userRecord->apellidos;  // set NombreCompleto
			$user->Estado = $userRecord->estado;
			$user->Email = $userRecord->email;
			$user->LastLogin = FechasMysql::ObtenerStringFechaMysql($userRecord->last_login,'H');

			return $user;
		}
		else
		return null;
	}

	/**
	 * Este metodo hace la respectiva consulta en la BD 
	 * para determinar si es un usuario valido
	 *
	 * @param unknown_type $login
	 * @param unknown_type $password
	 * @return unknown
	 */
	public function validateUser($login,$password)
	{
		// instancia de TActiveRecordCriteria que contiene las condiciones de la busqueda
		$criteria=new TActiveRecordCriteria;
		//solo trae los Usuarios que esten en estado activo
		$criteria->Condition = 'login = :login AND password = :password AND estado = 1';
		$criteria->Parameters[':login'] = trim($login);
		$criteria->Parameters[':password'] = trim($password);
		
		return UserRecord::finder()->find($criteria,$criteria->Parameters)!==null;
	}


}

?>