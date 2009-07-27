<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="es">
	<com:THead Title="SYM3" />
	<body>
		<com:TForm>	
			<b class="rtop_header">
		  		<b class="r1"></b> <b class="r2"></b> <b class="r3"></b> <b class="r4"></b>
			</b>
		
			<div class="wrapheader">
				<div id="title"> 
					<h1><span>SYM3</span></h1> 
					<div class="description"> 
						<small>Supervici&oacute;n y Manipulaci&oacute;n Mitsubishi Melfa</small> 
					</div> 
					<hr>
				</div> 
				
				<com:LoginControl Visible=<%= $this->User->IsGuest %>/>
				
				<div class="header">
					<com:MainMenu Visible=<%= !$this->User->IsGuest %>/>
				</div>
			</div>
			
			<div class="wrapmain">
				<table class="main">
					<tr>
						<td class="mainContainer">
							<com:TContentPlaceHolder ID="Main" />
						</td>
						<td class="sideContainer">
							<com:SideMenu Visible=<%= !$this->User->IsGuest %>/>
						</td>
					</tr>
				</table>
				<com:TPanel Id="PanelMensaje" CssClass="PanelMensaje" Visible="False">
					<com:TLabel Id="Mensaje"/>
				</com:TPanel>
			</div>

			<b class="rbottom">
			  <b class="r4"></b> <b class="r3"></b> <b class="r2"></b> <b class="r1"></b>
			</b>
			
			<com:StatusControl  Visible=<%= !$this->User->IsGuest %>/>
			
		</com:TForm>
		
		<div class="copyrights">
			<HR>
			<a href="http://atenea.lasalle.edu.co/facultades/disenoAutomatiza/">Facultad de Ingenier&iacute;a de Dise&ntilde;o y Automatizaci&oacute;n Electr&oacute;nica ID&AE <%=date('Y')%></a>.
			<br>
			<a href="http://unisalle.lasalle.edu.co/">Universidad de la Salle</a>
		</div>
	</body>
	<!--<com:TJavascriptLogger/>-->
</html>
