<?php
/**
 * Clase SideMenu.
 * 
 * @author Carlos Eduardo Jerez Paz
 * @link http://www.quider.net/
 * @copyright Copyright &copy; 2009 Quider
 * @version $Id: SideMenu.php Wed Jan 28 23:29:59 COT 2009 Carlos Eduardo 
 * @package SYM3
 */
class SideMenu extends TTemplateControl {


	private $_userId;
	private $_moduloId;

	/**
	 * Override de Oninit
	 *
	 * @param unknown_type $param
	 */
	public function onInit($param){
		parent::onInit($param);
		$this->_moduloId = TPropertyValue::ensureInteger($this->Request['modulo_id']);
		$this->_userId = TPropertyValue::ensureInteger($this->Application->User->Id);
	}

	/**
	 * Override de Onload
	 *
	 * @param unknown_type $param
	 */
	public function onLoad($param)
	{
		parent::onLoad($param);

		$this->Repeater->DataSource=$this->getData($this->_moduloId);
		$this->Repeater->dataBind();
	}

	/**
	 * Obtiene al arreglo de datos principal para el menu
	 *
	 * @param unknown_type $modulo_id
	 * @return unknown
	 */
	protected function getData()
	{
		if(isset($this->_userId)){
			$db = $this->Application->Modules['db']->Database;
			$db->Active = true;
			$sql="SELECT sys_seg_submodulos_id, sys_seg_modulos_id,nombre_submodulo
		    		FROM sys_seg_usuarios_has_submodulos_view
    				where sys_seg_usuarios_id=".$this->_userId."
    				AND sys_seg_modulos_id =".$this->_moduloId;

			$command=$db->createCommand($sql);
			$data= $command->query()->readAll();
			$db->Active = false;
			return $data;
		}
	}

	/**
	 * Hace el Bind de detalles por cada item en el arreglo principal
	 *
	 * @param unknown_type $sender
	 * @param unknown_type $param
	 */
	public function dataBindRepeater2($sender,$param)
	{
		$item=$param->Item;
		if($item->ItemType==='Item' || $item->ItemType==='AlternatingItem'){
			$item->Repeater2->DataSource=$this->getDetailData($item->DataItem['sys_seg_submodulos_id']);
			$item->Repeater2->dataBind();
		}
	}

	/**
	 * Obtiene el arreglo de datos de detalles, por cada de
	 *
	 * @param unknown_type $sender
	 * @param unknown_type $param
	 */
	protected function getDetailData($subModulo_id)
	{
		$uid = TPropertyValue::ensureInteger($this->Application->User->Id);
		if(isset($this->_userId)){
			$db = $this->Application->Modules['db']->Database;
			$db->Active = true;
			$sql="SELECT sys_seg_funciones_id, nombre_funcion,sys_seg_submodulos_id
		    		FROM sys_seg_usuarios_has_funciones_view
    				where sys_seg_usuarios_id=".$this->_userId."
    				AND sys_seg_submodulos_id =".$subModulo_id;

			$command=$db->createCommand($sql);
			$data= $command->query()->readAll();
			$db->Active = false;
			return $data;
		}
	}


}

?>