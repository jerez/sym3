<?php

/**
 * Clase FuncionesPerfil.
 *
 * @author Carlos Eduardo Jerez Paz
 * @link http://www.quider.net/
 * @copyright Copyright &copy; 2009 Quider
 * @version $Id: FuncionesPerfil.php Sat May 16 23:41:58 COT 2009 Carlos Eduardo 
 * @package SYM3
 */
class FuncionesPerfil extends TPage
{
	private $_hayData = false;
	private $_titulo = null;
	private $_perfilId = 0;

	public function onLoad($param)
	{
		parent::onLoad($param);
		if(!$this->IsPostBack && !$this->IsCallBack)
		{
			$this->IdPerfil = TPropertyValue::ensureInteger($this->Request['perfil_id']);
			if ($this->IdPerfil > 0) {

				$profileRecord = ProfileRecord::finder()->findByPk($this->IdPerfil);
				$this->_titulo = "Funciones $profileRecord->nombre_perfil";
				$this->DataList->DataSource=$this->Data;
				$this->DataList->dataBind();
			}
		}
	}


	/**
     * @return string Titulo de la lista Defaults to 'null'.
     */
	protected function getTitulo()
	{
		return $this->_titulo;
	}

	/**
     * @return string  Defaults to 'null'.
     */
	public function getHayData()
	{
		return $this->getViewState('HayData',false);
	}

	/**
     * @param string 
     */
	public function setHayData($value)
	{
		$this->setViewState('HayData',$value,false);
	}

	/**
     * @return string  Defaults to 'null'.
     */
	public function getIdPerfil()
	{
		return $this->getViewState('IdPerfil','null');
	}

	/**
     * @param string 
     */
	public function setIdPerfil($value)
	{
		$this->setViewState('IdPerfil',$value,'null');
	}


	/**
     * @return string  Defaults to 'null'.
     */
	public function getData()
	{
		if(!$this->HayData)
		$this->loadData();
		return $this->getViewState('Data','null');
	}

	/**
     * @param string 
     */
	protected function setData($value)
	{
		$this->setViewState('Data',$value,'null');
	}


	protected function loadData()
	{

		$db = $this->Application->Modules['db']->Database;
		$db->Active = true;
		$sql ="SELECT sys_seg_funciones_id
				FROM sys_seg_perfiles_has_funciones 
				WHERE sys_seg_perfiles_id=".$this->IdPerfil;

		$dataReader = $db->createCommand($sql)->query();
		$db->Active = false;

		$dataReader->bindColumn(1,$idFuncion);

		while($dataReader->read()!==false){
			$arrayIds[]=$idFuncion;
		}

		foreach (FuncionRecord::finder()->findAll() as $funcion) {
			$arrayData[$funcion->sys_seg_funciones_id] =
			array('sys_seg_funciones_id' => $funcion->sys_seg_funciones_id,'nombre_funcion' => $funcion->nombre_funcion,'tiene_funcion' => intval(in_array($funcion->sys_seg_funciones_id,$arrayIds)));
		}

		$this->HayData = true;
		$this->Data = $arrayData;

	}


	public function checkboxClicked($sender,$param)
	{
		$sender->Text = "<b>$sender->Text</b>";
		$arrayValores = $this->Data;
		$arrayValores[$param->CallbackParameter]['tiene_funcion'] =  TPropertyValue::ensureInteger($sender->Checked);
		$this->Data = $arrayValores;
	}

	public function OkButtonClicked($sender,$param)
	{
		$db = $this->Application->Modules['db']->Database;
		$db->Active = true;
		$sql ="DELETE FROM sys_seg_perfiles_has_funciones
				WHERE sys_seg_perfiles_id=".$this->IdPerfil;

		$transaction = $db->beginTransaction();
		try
		{
			$command = $db->createCommand($sql);
			$command->execute();
			foreach ($this->getData() as $funcion) {
				if ($funcion['tiene_funcion']) {
					$command->Text = "INSERT INTO sys_seg_perfiles_has_funciones(sys_seg_perfiles_id,sys_seg_funciones_id)
									  values($this->IdPerfil,{$funcion['sys_seg_funciones_id']})";
					$command->execute();
				}
			}

			$transaction->commit();
		}
		catch(Exception $e)
		{
			$transaction->rollBack();
		}

		$db->Active = false;

	}

}

?>