<?php
/**
 * Clase MainMenu.
 * 
 * @author Carlos Eduardo Jerez Paz
 * @link http://www.quider.net/
 * @copyright Copyright &copy; 2009 Quider
 * @version $Id: MainMenu.php Wed Jan 28 23:29:59 COT 2009 Carlos Eduardo 
 * @package SYM3
 */
class MainMenu extends TTemplateControl {
	
	/**
	 * Contiene el nombre de acceso de la pagina requerida
	 *
	 * @var unknown_type
	 */
	private $_identificadorPagina;
	
	/**
	 * Override de OnInit
	 * @see TPage.OnInit
	 *
	 */
	public function onInit($param) {
		parent::onInit ( $param );
		
		$this->_identificadorPagina = TPropertyValue::ensureString ( $this->Request ['page'] );
	}
	
	/**
	 * Override de Onload
	 * @see TPage.OnLoad
	 * 
	 * @param unknown_type $param
	 */
	public function onLoad($param) {
		parent::onLoad ( $param );
		
		$this->Repeater->DataSource = $this->getData ();
		$this->Repeater->dataBind ();
	}
	
	/**
	 * Getter para el campo privado _identificadorPagina
	 *
	 */
	public function getIdentificadorPagina() {
		return $this->_identificadorPagina;
	}
	
	/**
	 * Obtiene el dataset de Modulos desde la base de datos
	 *
	 * @return TDataList
	 */
	protected function getData() {
		$uid = TPropertyValue::ensureInteger ( $this->Application->User->Id );
		if (isset ( $uid )) {
			$db = $this->Application->Modules ['db']->Database;
			$db->Active = true;
			$sql = "SELECT sys_seg_modulos_id, nombre_modulo
		    		FROM sys_seg_usuarios_has_modulos_view
    				where sys_seg_usuarios_id=" . $uid;
			
			$command = $db->createCommand ( $sql );
			$data = $command->query ()->readAll ();
			$db->Active = false;
			return $data;
		}
	}

}

?>