<?php

/**
 * Clase GestionRecursos.
 * 
 * @author Carlos Eduardo Jerez Paz
 * @link http://www.quider.net/
 * @copyright Copyright &copy; 2009 Quider
 * @version $Id: GestionRecursos.php Mon Feb 09 21:51:22 COT 2009 Carlos Eduardo 
 * @package SYM3.pages
 */
class GestionRecursos extends DatagridBasePage{
	function onLoad($param)
	{
		parent::onLoad($param);
		$this->Master->Validar=false;
	}

	/**
	 * Implementa el metodo DataKeyField
	 *
	 */
	protected function GetDatakey(){
		return 'sys_seg_recursos_id';
	}

	/**
	 * Implementa el metodo DataKeyType
	 *
	 */
	protected function GetDataType(){
		return 'RecursoRecord';
	}


	/**
	 * Implementa el Metodo Handler itemCreated
	 *
	 */
	protected function itemCreated($sender,$param){
		$item=$param->Item;

		if($item->ItemType==='EditItem')
		{
			$cell = $item->Cells[0];
			$cell->Controls->clear();
			$list = new TDropDownList();
			$list->DataSource=$this->ObtenerRecursosDisponibles();
			$cell->Controls->add($list);
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
//		if (isset($this->List)) {
	$cell = $item->Cells[0];
	$list = $cell->Controls[0];
			$record->identificador_recurso = $list->SelectedValue;
	//	}else{
		//	$record->identificador_recurso = $item->IdentificadorRecursoColumn->Text;
		//}
		//$cell = $item->Cells[0];


		//$record->identificador_recurso=$item->IdentificadorRecursoColumn->List->SelectedValue;
		//$record->identificador_recurso=$item->IdentificadorRecursoColumn->Text;
		$record->sys_seg_funciones_id=$item->FuncionColumn->DropDownList->SelectedValue;
		$record->es_principal = $item->PrincipalColumn->CheckBox->Checked;
		$record->estado = $item->EstadoColumn->CheckBox->Checked;
	}

	/**
	 * Carga Todas las funciones para poblar el DropDown List
	 *
	 * @return unknown
	 */
	public function loadFunciones()
	{
		return FuncionRecord::finder()->findAll();
	}


	/**
	 * Override de GetNestedTypes
	 * Retorna instancias vacias de los tipos anidados necesarios para crear un nuevo objeto
	 *
	 * @return unknown
	 */
	protected function GetNestedTypes(){
		return array(
		'funcion'=>new FuncionRecord(array()),
		);
	}

	/**
	 * Obtiene los recursos disponibles
	 * Realizando la diferencia entre los registrado y los de el sistema
	 *
	 * @return array
	 */
	protected function ObtenerRecursosDisponibles(){
		return	array_diff($this->ObtenerRecursosFS(),$this->ObtenerRecursosBD());
	}

	/**
	 * Obtinene los identificadores a partir de los nombres de archivo del sistema
	 *
	 * @return array
	 */
	protected function ObtenerRecursosFS(){
		$array_identificadores=array();
		$path = Prado::getPathOfNamespace('Application.pages');
		$recursos = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path), RecursiveIteratorIterator::SELF_FIRST);

		foreach($recursos as $name => $object){
			$patron='\.(page)$';
			if(!is_dir($name) && (ereg($patron, $name))){
				$recurso =ereg_replace($patron,'',
				str_replace(DIRECTORY_SEPARATOR,'.',
				str_replace($path.DIRECTORY_SEPARATOR,'',$name)));

				if (strtolower($recurso)!='home')$array_identificadores[$recurso]=$recurso;
			}
		}
		return $array_identificadores;
	}

	/**
	 * Obtiene los recursos en base de datos
	 *
	 * @return array
	 */
	protected function ObtenerRecursosBD(){
		$db = $this->Application->Modules['db']->Database;
		$db->Active = true;
		$sql ="select identificador_recurso
					from sys_seg_recursos";
		$data = $db->createCommand($sql)->query()->readAll();
		$db->Active = false;

		$vector_retorno =array();
		foreach ($data as $key => $valor) {
			$vector_retorno[]=$valor['identificador_recurso'];
		}
		return $vector_retorno;
	}

}

?>