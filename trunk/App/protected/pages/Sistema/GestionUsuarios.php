<?php

/**
 * Clase GestionUsuarios.
 * 
 * @author Carlos Eduardo Jerez Paz
 * @link http://www.quider.net/
 * @copyright Copyright &copy; 2009 Quider
 * @version $Id: GestionUsuarios.php Wed Feb 04 17:55:16 COT 2009 Carlos Eduardo 
 * @package SYM3 Pages
 */
class GestionUsuarios extends DatagridBasePage 
{
	
	/**
	 * Implementa el metodo DataKeyField
	 *
	 */
	protected function GetDatakey(){
		return 'sys_seg_usuarios_id';
	}
	
	/**
	 * Implementa el metodo DataKeyType
	 *
	 */
	protected function GetDataType(){
		return 'UserRecord';
	}

	
	/**
	 * Implementa el Metodo Handler itemCreated
	 *
	 */
	protected function itemCreated($sender,$param)
	{
		$item=$param->Item;
		if($item->ItemType==='EditItem')
		{
			$item->NombresColumn->NombresTextBox->Columns=15;
			$item->ApellidosColumn->ApellidosTextBox->Columns=15;
			$item->EmailColumn->EmailTextBox->Columns=15;
			$item->LoginColumn->txtPasswd->Columns=15;
			$item->LoginColumn->txtLogin->Columns=15;
		}
	}

	/**
	 * Implementa el metodo setear valores guardar,
	 * para insertar los valores particulares de esta clase.
	 *
	 * @param TDataGridItem $item
	 * @param TActiveRecord $record
	 */
	protected function SetearValoresGuardar($item,$record){
		$record->nombres=$item->NombresColumn->NombresTextBox->Text;
		$record->apellidos=$item->ApellidosColumn->ApellidosTextBox->Text;
		$record->email=$item->EmailColumn->EmailTextBox->Text;
		$record->estado=$item->EstadoColumn->CheckBox->Checked;
		$record->password =md5($item->LoginColumn->txtPasswd->Text);
		if (ltrim(rtrim($record->login))=="") {
			$record->login=$item->LoginColumn->txtLogin->Text;
		}
		print_r($record);
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