<?php

class ParametrosSistema extends TPage
{

	public function onLoad($param)
	{
		parent::onLoad($param);
		if(!$this->IsPostBack && !$this->IsCallBack)
		{
			$registro = SistemaRecord::finder()->findByPk(1);

			$this->DominioTextBox->Text = $registro->dominio_aplicacion;
			$this->EmailAdministrador->Text = $registro->email_administrador;
			$this->IpCamaraTextBox->Text = $registro->direccion_ip_camara;
		}
	}

	public function GuardarClicked($sender,$param)
	{
		$registro = SistemaRecord::finder()->findByPk(1);
		
		$registro->dominio_aplicacion = $this->DominioTextBox->Text;
		$registro->email_administrador = $this->EmailAdministrador->Text;
		$registro->direccion_ip_camara = $this->IpCamaraTextBox->Text;

		$registro->save();
	}
}

?>