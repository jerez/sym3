<com:TClientScriptLoader PackagePath="Application.js" PackageScripts="tree"/>
<div id="sideMenu_top">&nbsp;</div>
<div id="sideMenu">
	<ul class="tree">
		<com:TRepeater ID="Repeater"
			OnItemDataBound="dataBindRepeater2" >
			<prop:ItemTemplate>
			<li class="closed">
				<com:THyperLink 
					Text=<%#$this->Data['nombre_submodulo']%> />		
				<ul>
					<com:TRepeater ID="Repeater2" >
						<prop:ItemTemplate>
						<li>
							<com:THyperLink 
								Text=<%#$this->Data['nombre_funcion']%> 
								NavigateUrl=<%#$this->Service->constructUrl('LoggedPage',array('submodulo_id'=>$this->Data['sys_seg_submodulos_id'],'funcion_id'=>$this->Data['sys_seg_funciones_id'])) %>/>
						</li>	
						</prop:ItemTemplate>
					</com:TRepeater>
				</ul>
				
			</li>	
			</prop:ItemTemplate>
		</com:TRepeater>
	</ul>
</div>
<div id="sideMenu_bottom">&nbsp;</div>


