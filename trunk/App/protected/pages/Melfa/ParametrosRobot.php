<?php

class ParametrosRobot extends TPage
{
	public function onLoad($param)
	{
		parent::onLoad($param);
		if(!$this->IsPostBack && !$this->IsCallBack)
		{
			$registro = MelfaRecord::finder()->findByPk(1);

			$this->IpRobotTextBox->Text = $registro->direccion_ip;
			$this->PuertoTextBox->Text = $registro->puerto;
			$this->TimeoutTextBox->Text = $registro->timeout;
			$this->DesplazamientoTextBox->Text = $registro->desplazamiento;
			$this->VelocidadTextBox->Text = $registro->velocidad;
		}
	}

	public function GuardarClicked($sender,$param)
	{
		$registro = MelfaRecord::finder()->findByPk(1);
		
		$registro->direccion_ip = $this->IpRobotTextBox->Text;
		$registro->puerto = $this->PuertoTextBox->Text;
		$registro->timeout = $this->TimeoutTextBox->Text;
		$registro->desplazamiento = $this->DesplazamientoTextBox->Text;
		$registro->velocidad = $this->VelocidadTextBox->Text;

		$registro->save();
	}

}

?>