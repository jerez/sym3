<?php

/**
 * Clase DatagridBasePage.
 * Refactoring
 * Se crea para serir de base a las paginas que contienen Datagrid
 * 
 * @author Carlos Eduardo Jerez Paz
 * @link http://www.quider.net/
 * @copyright Copyright &copy; 2009 Quider
 * @version $Id: DatagridBasePage.php Fri Feb 06 02:54:44 COT 2009 Carlos Eduardo 
 * @package SYM3.Common
 */
Prado::using('Application.common.XActiveDatagrid');
abstract class DatagridBasePage extends TPage{

	protected $_data=null;
	protected $_datakey = 'key';
	protected $_dataType = 'type';

	/**
	 * Override de Oninit
	 * Se setean las propiedades iniciales de el Datagrid
	 *
	 * @param unknown_type $param
	 */
	function onInit($param) {
		parent::onInit($param);
		/**
		 * Propiedades comunes del datagrid
		 */
		$this->DataGrid->AutoGenerateColumns=false;
		$this->DataGrid->AlternatingItemStyle->CssClass="dgAlternateItem";
		$this->DataGrid->ItemStyle->CssClass="dgItem";
		$this->DataGrid->EditItemStyle->CssClass="dgEditItem";
		$this->DataGrid->AllowSorting=true;
		$this->DataGrid->AllowPaging=true;
		$this->DataGrid->PageSize=10;
		$this->DataGrid->PagerStyle->Mode="Numeric";
		$this->DataGrid->ShowFooter=true;
		 
		/**
		 * Agrega los Handlers
		 */
		$this->DataGrid->attachEventHandler("OnItemCreated",array($this,'itemCreated'));
		$this->DataGrid->attachEventHandler("OnEditCommand",array($this,"editItem"));
		$this->DataGrid->attachEventHandler("OnUpdateCommand",array($this,"saveItem"));
		$this->DataGrid->attachEventHandler("OnCancelCommand",array($this,"cancelItem"));
		$this->DataGrid->attachEventHandler("OnPagerCreated",array($this,"pagerCreated"));
		$this->DataGrid->attachEventHandler("OnPageIndexChanged",array($this,"changePage")); 

	}
	
	/**
	 * Indica cual es el tipo de dato al que el datagrid hara el binding
	 * Debe ser implementado en las clases hijas
	 * 
	 * @return string DataKeyField
	 */
	protected abstract function GetDataType();
	
	/**
	 * Indica cual va  a ser la llave de el datagrid
	 * Debe ser implementado en las clases hijas
	 * 
	 * @return string DataKeyField
	 */
	protected abstract function GetDatakey();
	
	/**
	 * Override de OnPreInit @see TPage.OnPreInit
	 * para asignar el DataKeyField Adecuado al datagrid
	 *
	 * @param unknown_type $param
	 */
	public function onPreLoad($param){
		parent::onPreLoad($param);
		$this->DataGrid->DataKeyField = $this->GetDatakey();
	}
	
	/**
	 * Override de Onload
	 * Se usa para hacer el binding del datasource y desplegar el datagrid
	 *
	 * @param unknown_type $param
	 */
	public function onLoad($param){
		parent::onLoad($param);
		if(!$this->IsPostBack){
			$this->DataGrid->DataSource=$this->Data;
			$this->DataGrid->dataBind();
		}
		
	}

	/**
	 * Retorna el Dataset adecuado, de acuerdo a la implementacion de @see loadData
	 *
	 * @return Array
	 */
	protected function getData(){
		if ($this->_data===null){
			$this->_data=$this->loadData();
		}
		return $this->_data;
	}

	/**
	
	 * carga el dataset desde BD
	 *
	 * @return unknown
	 */
	protected function loadData(){
		return TActiveRecord::finder($this->GetDataType())->findAll();
	}

	/**
	 * Handler itemCreated
	 * Debe ser implementad por cada clase hija
	 *
	 */
	protected abstract function itemCreated($sender,$param);

	/**
	 * Handler de EditItem
	 * Cuando se hace click en EditItem (Boton), se forza un nuevo binding
	 *
	 */
	protected function editItem($sender,$param){
		$this->BindDataGrid($param->Item->ItemIndex);
	}

	/**
	 * Guardar el item Editado o creado según sea el caso
	 * Se encarga de asignar los valores de PK según sea, 
	 * y llama al metodo SetearValoresGuardar, metodo abstracto 
	 * que debe ser implementado por cada clase hija para asignar 
	 * los respectivos valores **No incluir PK**
	 * 
	 *
	 */
	protected function saveItem($sender,$param){
		$item = $param->Item;
		$index = $this->DataGrid->DataKeys[$item->ItemIndex];
		$dataType = $this->GetDataType();
		$datakey = $this->GetDatakey();

		$record = TActiveRecord::finder($dataType)->findByPk($index);
		if ($record===null && $index===0) {
			$nuevoId=TActiveRecord::finder($dataType)->count()+1;
			$record =new $dataType(array($datakey=>$nuevoId));
		}
		
		$this->SetearValoresGuardar($item,$record);
		
		//Guardar
		$record->save();
		$this->BindDataGrid();
	}
	
	/**
	 * Pasa por referencia los objetos item y record para que la clase implementadora
	 * ponga los valores adecuados en la instancia @$record
	 *
	 * @param TDataGridItem $item
	 * @param TActiveRecord $record
	 */
	protected abstract function SetearValoresGuardar($item,$record);

	
	/**
	 * Cancelar la accion
	 * Cancela la edicion activa y retoirna al estado anterior, para ello es necesario forzar de nuevo el binding
	 *
	 */
	protected function cancelItem($sender,$param){
		$this->BindDataGrid();
	}

	/**
	 * Handler changePage
	 * Manipula adecuadamente el cambio de página
	 *
	 */
	protected function changePage($sender,$param){
		$this->DataGrid->CurrentPageIndex=$param->NewPageIndex;
		$this->BindDataGrid();
	}

	/**
     * Handler pagerCreated
     * Personaliza la creación del elemento pager
     *
     */
	protected function pagerCreated($sender,$param){
		$param->Pager->Controls->insertAt(0,'P&aacute;gina: ');
	}

	/**
	 * Se encarga de Ejecutar el Binding
	 * Recibe el indice de el item seleccionado
	 * 
	 * @param  int $itemIndex
	 */
	protected function BindDataGrid($itemIndex=-1){
		$this->DataGrid->EditItemIndex=$itemIndex;
		$this->DataGrid->DataSource=$this->Data;
		$this->DataGrid->dataBind();
	}
	
	/**
	 * Agrega un nuevo item al Datasource, solo en memoria (ViewState)
	 *
	 * @param unknown_type $record
	 */
	protected function AddToData($record){
		//Copia el contenido actual en un array
		$actualData=$this->Data;
		//combina los valores
		array_push($actualData,$record);
		//asigna al campo privado el nuevo array;
		$this->_data=$actualData;
	}
	
	/**
	 * Crea un registro tempoiral en el datagrid
	 * y habilita la edición de esta, solo sera guardado en base de datos una vez se envie el request adecuado
	 *
	 * @param unknown_type $sender
	 * @param unknown_type $param
	 */
	protected function NewRecordClicked($sender, $param)
	{
		$arrayValores =array($this->GetDatakey()=>0);

		if (is_array($this->GetNestedTypes())){			
			$arrayValores = array_merge($arrayValores,$this->GetNestedTypes());
		}
		
		$record =TActiveRecord::createRecord($this->GetDataType(), $arrayValores);
		$this->AddToData($record);
		
		$cantidadRegistros = sizeof($this->Data);
		$numeroPagina = ceil($cantidadRegistros/$this->DataGrid->PageSize);
		$posicionPagina = ($cantidadRegistros-(($numeroPagina-1)*$this->DataGrid->PageSize))-1;
		
		$this->DataGrid->CurrentPageIndex=$numeroPagina;
		$this->BindDataGrid($posicionPagina);
	}

	/**
	 * Metodo Abstracto que debe retoirnar en forma de array
	 * instancias vacias de sus tipos anidados, con el objeto de crear
	 * un nuevo objeto valido en el datagrid
	 *
	 * Debe ser implementado por cada una de las clases Hijas,
	 * si estas no poseen tipos anidados deberan retornar NULL
	 * 
	 */
	protected abstract function GetNestedTypes();
}


?>