<?php
Prado::using('Application.common.Mensajes');
class MainLayout extends TTemplateControl
{
	function onLoad($param)
	 {
	    parent::onLoad($param);
	    
	    $mensajeId = TPropertyValue::ensureInteger($this->Request['mensaje_id']);
	    if (isset($mensajeId) && $mensajeId!==0) {
	    	$this->PanelMensaje->Visible= true;
	    	$this->Mensaje->Text = Mensajes::Singleton()->GetById($mensajeId);
	    }
	 }
}

?>