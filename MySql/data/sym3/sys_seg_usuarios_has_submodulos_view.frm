TYPE=VIEW
query=select `e`.`sys_seg_usuarios_id` AS `sys_seg_usuarios_id`,`a`.`sys_seg_modulos_id` AS `sys_seg_modulos_id`,`b`.`sys_seg_submodulos_id` AS `sys_seg_submodulos_id`,`b`.`nombre_submodulo` AS `nombre_submodulo` from ((((`sym3`.`sys_seg_modulos` `a` join `sym3`.`sys_seg_submodulos` `b` on((`a`.`sys_seg_modulos_id` = `b`.`sys_seg_modulos_id`))) join `sym3`.`sys_seg_funciones` `c` on((`b`.`sys_seg_submodulos_id` = `c`.`sys_seg_submodulos_id`))) join `sym3`.`sys_seg_perfiles_has_funciones` `d` on((`c`.`sys_seg_funciones_id` = `d`.`sys_seg_funciones_id`))) join `sym3`.`sys_seg_usuarios_has_perfiles` `e` on((`d`.`sys_seg_perfiles_id` = `e`.`sys_seg_perfiles_id`))) where ((`a`.`estado` = 1) and (`b`.`estado` = 1) and (`c`.`estado` = 1) and (`c`.`visible_menu` = 1)) group by `a`.`sys_seg_modulos_id`,`b`.`nombre_submodulo`
md5=a456110ea4ee9cc8816d21038395ad5a
updatable=0
algorithm=0
definer_user=root
definer_host=localhost
suid=2
with_check_option=0
timestamp=2009-07-16 05:23:06
create-version=1
source=select e.sys_seg_usuarios_id,\n       a.sys_seg_modulos_id,\n       b.sys_seg_submodulos_id,\n       b.nombre_submodulo\nfrom sys_seg_modulos a\n  join sys_seg_submodulos b on a.sys_seg_modulos_id = b.sys_seg_modulos_id\n  join sys_seg_funciones c on b.sys_seg_submodulos_id = c.sys_seg_submodulos_id\n  join sys_seg_perfiles_has_funciones d on c.sys_seg_funciones_id = d.sys_seg_funciones_id\n  join sys_seg_usuarios_has_perfiles e on d.sys_seg_perfiles_id = e.sys_seg_perfiles_id\nwhere a.estado = 1\n  and b.estado = 1\n  and (c.estado = 1 and c.visible_menu=1)\ngroup by a.sys_seg_modulos_id,b.nombre_submodulo
