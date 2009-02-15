<%@ MasterClass="Application.layouts.MainLayout"%>
<com:TContent ID="Main">
	<com:TClientScript PradoScripts="validator" />
	<com:TContentPlaceHolder ID="DataGridHolder"/>
	<div align="center" class="dgFooter">
		<com:TActiveButton
					    Text="Nuevo Registro"
					    CssClass="boton"
					    OnCommand="Page.NewRecordClicked"
					    CausesValidation="false"/>
	</div>	
</com:TContent>