<?php

/**
 * Clase GestionSubModulos
 * 
 * @author Carlos Eduardo Jerez Paz
 * @link http://www.quider.net/
 * @copyright Copyright &copy; 2009 Quider
 * @version $Id: GestionModulos.php Fri Feb 06 04:57:27 COT 2009 Carlos Eduardo 
 * @package SYM3 Pages
 */
class GestionFunciones extends DatagridBasePage 
{
		
	/**
	 * Implementa el metodo DataKeyField
	 *
	 */
	protected function GetDatakey(){
		return 'sys_seg_funciones_id';
	}
	
	/**
	 * Implementa el metodo DataKeyType
	 *
	 */
	protected function GetDataType(){
		return 'FuncionRecord';
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
        $record->sys_seg_submodulos_id=$item->SubModuloColumn->DropDownList->SelectedValue;
		$record->nombre_funcion=$item->NombreFuncionColumn->NombreTextBox->Text;
		$record->visible_menu = $item->VisibleMenuColumn->CheckBox->Checked;
		$record->estado = $item->EstadoColumn->CheckBox->Checked;
	}
	
	/**
	 * Carga Todos los modulos para poblar el DropDown List
	 *
	 * @return unknown
	 */
	public function loadSubModulos()
	{
		return SubModuloRecord::finder()->findAll();
	}
	
	
	/**
	 * Override de GetNestedTypes
	 * Retorna instancias vacias de los tipos anidados necesarios para crear un nuevo objeto
	 *
	 * @return unknown
	 */
	protected function GetNestedTypes(){
		return array(
			'submodulo'=>new SubModuloRecord(array()),
		);
	}
	
}
?>