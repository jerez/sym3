<div id="menu"> 
	<div class="menu_container">  
		<ul> 
			<com:TRepeater ID="Repeater" >
				<prop:ItemTemplate>
					<li>
						<com:THyperLink 
							Text=<%#$this->Data['nombre_modulo']%> 
							NavigateUrl=<%#$this->Service->constructUrl($this->Parent->Parent->getIdentificadorPagina(),array('modulo_id'=>$this->Data['sys_seg_modulos_id'])) %>/>
					</li>
				</prop:ItemTemplate>
			</com:TRepeater>
		</ul> 
	 </div>
	 <span class="menu_end"></span> 
</div> 