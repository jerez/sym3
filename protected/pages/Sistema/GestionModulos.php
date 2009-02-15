<?php

/**
 * Clase GestionModulos.
 * 
 * @author Carlos Eduardo Jerez Paz
 * @link http://www.quider.net/
 * @copyright Copyright &copy; 2009 Quider
 * @version $Id: GestionModulos.php Fri Feb 06 04:57:27 COT 2009 Carlos Eduardo 
 * @package SYM3 Pages
 */
class GestionModulos extends DatagridBasePage 
{
		
	/**
	 * Implementa el metodo DataKeyField
	 *
	 */
	protected function GetDatakey(){
		return 'sys_seg_modulos_id';
	}
	
	/**
	 * Implementa el metodo DataKeyType
	 *
	 */
	protected function GetDataType(){
		return 'ModuloRecord';
	}

	
	/**
	 * Implementa el Metodo Handler itemCreated
	 *
	 */
	protected function itemCreated($sender,$param)
	{
		$item=$param->Item;
	}

	/**
	 * Implementa el metodo setear valores guardar,
	 * para insertar los valores particulares de esta clase.
	 *
	 * @param TDataGridItem $item
	 * @param TActiveRecord $record
	 */
	protected function SetearValoresGuardar($item,$record){
		$record->nombre_modulo=$item->NombreModuloColumn->NombreTextBox->Text;

	}
	
	/**
	 * Implementación de GetNestedTypes
	 * No aplica para esta clase
	 *
	 */
	protected function GetNestedTypes(){
		return null;
	}
	
}
?>