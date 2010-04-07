<?php
/**
 * Clase PerfilesUsuarios.
 *
 * @author Carlos Eduardo Jerez Paz
 * @link http://www.quider.net/
 * @copyright Copyright &copy; 2009 Quider
 * @version $Id: PerfilesUsuarios.php Sat May 16 23:41:58 COT 2009 Carlos Eduardo 
 * @package SYM3
 */
class PerfilesUsuarios extends TPage
{
	private $_hayData = false;
	private $_titulo = null;
	private $_perfilId = 0;

	public function onLoad($param)
	{
		parent::onLoad($param);
		if(!$this->IsPostBack && !$this->IsCallBack)
		{
			$this->IdUsuario = TPropertyValue::ensureInteger($this->Request['usuario_id']);
			if ($this->IdUsuario > 0) {

				$userRecord = UserRecord::finder()->findByPk($this->IdUsuario);
				$this->_titulo = strtoupper("$userRecord->nombres $userRecord->apellidos");
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
	public function getIdUsuario()
	{
		return $this->getViewState('IdUsuario','null');
	}

	/**
     * @param string 
     */
	public function setIdUsuario($value)
	{
		$this->setViewState('IdUsuario',$value,'null');
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
		$sql ="SELECT sys_seg_perfiles_id
				FROM sys_seg_usuarios_has_perfiles 
				WHERE sys_seg_usuarios_id=".$this->IdUsuario;

		$dataReader = $db->createCommand($sql)->query();
		$db->Active = false;

		$dataReader->bindColumn(1,$idPerfil);

		$arrayIds=array();
		while($dataReader->read()!==false){
			$arrayIds[]=$idPerfil;
		}

		foreach (ProfileRecord::finder()->findAll() as $perfil) {
			$arrayData[$perfil->sys_seg_perfiles_id] =
			array('sys_seg_perfiles_id' => $perfil->sys_seg_perfiles_id,'nombre_perfil' => $perfil->nombre_perfil,'tiene_perfil' => intval(in_array($perfil->sys_seg_perfiles_id,$arrayIds)));
		}

		$this->HayData = true;
		$this->Data = $arrayData;

	}


	public function checkboxClicked($sender,$param)
	{
		$sender->Text = "<b>$sender->Text</b>";
		$arrayValores = $this->Data;
		$arrayValores[$param->CallbackParameter]['tiene_perfil'] =  TPropertyValue::ensureInteger($sender->Checked);
		$this->Data = $arrayValores;
	}

	public function OkButtonClicked($sender,$param)
	{
		$db = $this->Application->Modules['db']->Database;
		$db->Active = true;
		$sql ="DELETE FROM sys_seg_usuarios_has_perfiles
				WHERE sys_seg_usuarios_id=".$this->IdUsuario;

		$transaction = $db->beginTransaction();
		try
		{
			$command = $db->createCommand($sql);
			$command->execute();
			foreach ($this->getData() as $perfil) {
				if ($perfil['tiene_perfil']) {
					$command->Text = "INSERT INTO sys_seg_usuarios_has_perfiles(sys_seg_usuarios_id,sys_seg_perfiles_id)
									  values($this->IdUsuario,{$perfil['sys_seg_perfiles_id']})";
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