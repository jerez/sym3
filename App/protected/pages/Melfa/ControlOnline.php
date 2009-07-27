<?php

class ControlOnline extends TPage
{
	private $_controladorMelfa;

	public function onLoad($param)
	{
		parent::onLoad($param);
		if(!$this->IsPostBack)
		{
			if(!$this->IsCallBack) $this->_controladorMelfa = new Melfa();

			$data=array('Waist','Shoulder','Elbow','Twist','Pitch','Roll');
			$this->DBRadioButtonList2->DataSource=$data;
			$this->DBRadioButtonList2->dataBind();
		}
	}


	public function OnAbrirPinzaClicked($sender,$param)
	{
		$this->_controladorMelfa->AbrirPinza();
	}

	public function OnCerrarPinzaClicked($sender,$param)
	{
		$this->_controladorMelfa->CerrarPinza();
	}

	public function OnEjecutarProgramaClicked($sender,$param)
	{
		$this->_controladorMelfa->EjecutarPrograma();
	}

	public function OnDetenerClicked($sender,$param)
	{
		$this->_controladorMelfa->DetenerPrograma();
	}

	public function OnIzqClicked($sender,$param)
	{
		$this->_controladorMelfa->MoverArticulacion($this->ObtenerArticulacionSeleccionada(),false);
	}

	public function OnDerClicked($sender,$param)
	{
		$this->_controladorMelfa->MoverArticulacion($this->ObtenerArticulacionSeleccionada());
	}

	private function ObtenerArticulacionSeleccionada()
	{
		$indices = $this->DBRadioButtonList2->SelectedIndices;
		//solo se selecciona un valor
		$item = $this->DBRadioButtonList2->Items[$indices[0]];
		return  $item->Value;
	}

}

?>