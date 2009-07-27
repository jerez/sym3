<?php

class VideoControl extends TTemplateControl
{
	private $_ipCamara;
	public function onLoad($param)
	{
		parent::onLoad($param);

		$registro = SistemaRecord::finder()->findByPk(1);
		$this->_ipCamara = $registro->direccion_ip_camara;

	}

	public function ObtenerIpCamara()
	{
		return $this->_ipCamara;
	}
}

?>