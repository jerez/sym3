<div class="linkControlVideo">
	<com:Application.componentes.LightWindow.TLightWindow 
	    Href="#<%=$this->LightWindowContent->getClientID()%>"
	    Title="Supervision Visual"
	    Height="245"
	    Width="325"
	/>
</div>
<com:TPanel ID="LightWindowContent" >
    <OBJECT classid="clsid:9BE31822-FDAD-461B-AD51-BE1D1C159921" 
		codebase="http://downloads.videolan.org/pub/videolan/vlc/latest/win32/axvlc.cab" 
		width="320" 
		height="240" 
		id="vlc" 
		events="True"> 
		<param name="Src" value="http://@<%=$this->ObtenerIpCamara()%>/img/mjpeg.cgi" /> 
		<param name="ShowDisplay" value="True" /> 
		<param name="AutoLoop" value="False" /> 
		<param name="AutoPlay" value="True" /> 
		<EMBED pluginspage="http://www.videolan.org" 
			type="application/x-vlc-plugin" progid="VideoLAN.VLCPlugin.2" 
			width="320" 
			height="240" 
			autoplay="yes" 
			loop="no" 
			target="http://@<%=$this->ObtenerIpCamara()%>/img/mjpeg.cgi" 
			name="vlc"> 
		</EMBED>
	</OBJECT> 
</com:TPanel>
