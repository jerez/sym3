<center>
<div id="login_control"> 
	<div class="login_container"> 
		<com:TActivePanel DefaultButton="LoginButton">
		
			<com:TLabel	ForControl="Username" Text="Usuario" />
		
			<com:TTextBox ID="Username"	AccessKey="u" ValidationGroup="login"/>	
		
			<com:TActiveLabel Id="labelPassword" ForControl="Password"	Text="Contrase&ntilde;a" />
		
			<com:TTextBox ID="Password"	AccessKey="p" ValidationGroup="login" TextMode="Password"/>
		
			<com:TButton ID="LoginButton" ValidationGroup="login" CssClass="login_img" />
	
			<com:TRequiredFieldValidator
				ControlToValidate="Username"
				ValidationGroup="login"
				Display="Dynamic"
				ErrorMessage="<br>Debe ingresar Nombre de usuario"/>
						
			
			<com:TActiveCustomValidator
			    ControlToValidate="Password"
			    Text="Contrase&ntilde;a incorrecta"
			    Display="Dynamic"
				ValidationGroup="login"
			    OnServerValidate="validateUser">
			    <prop:ClientSide.OnLoading>
			        $('<%= $this->labelPassword->ClientID %>').innerHTML = "<b>Validando Contrase&ntilde;a...</b>"
			    </prop:ClientSide.OnLoading>
			    <prop:ClientSide.OnComplete>
			        $('<%= $this->labelPassword->ClientID %>').innerHTML = "Contrase&ntilde;a"
			    </prop:ClientSide.OnComplete>
			</com:TActiveCustomValidator>
			
	

					
		</com:TActivePanel>
		 </div>
	 <span class="login_end"></span> 
</div>
</center>