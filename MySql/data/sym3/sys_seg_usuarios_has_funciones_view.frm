TYPE=VIEW
query=select `e`.`sys_seg_usuarios_id` AS `sys_seg_usuarios_id`,`b`.`sys_seg_submodulos_id` AS `sys_seg_submodulos_id`,`c`.`sys_seg_funciones_id` AS `sys_seg_funciones_id`,`c`.`nombre_funcion` AS `nombre_funcion` from ((((`sym3`.`sys_seg_modulos` `a` join `sym3`.`sys_seg_submodulos` `b` on((`a`.`sys_seg_modulos_id` = `b`.`sys_seg_modulos_id`))) join `sym3`.`sys_seg_funciones` `c` on((`b`.`sys_seg_submodulos_id` = `c`.`sys_seg_submodulos_id`))) join `sym3`.`sys_seg_perfiles_has_funciones` `d` on((`c`.`sys_seg_funciones_id` = `d`.`sys_seg_funciones_id`))) join `sym3`.`sys_seg_usuarios_has_perfiles` `e` on((`d`.`sys_seg_perfiles_id` = `e`.`sys_seg_perfiles_id`))) where ((`a`.`estado` = 1) and (`b`.`estado` = 1) and (`c`.`estado` = 1) and (`c`.`visible_menu` = 1)) group by `c`.`sys_seg_funciones_id`,`c`.`nombre_funcion`
md5=9a9c0611ca3253b87773991f453e2f11
updatable=0
algorithm=0
definer_user=root
definer_host=localhost
suid=2
with_check_option=0
timestamp=2009-07-16 05:23:06
create-version=1
source=select e.sys_seg_usuarios_id,\n       b.sys_seg_submodulos_id,\n       c.sys_seg_funciones_id,\n       c.nombre_funcion\nfrom sys_seg_modulos a\n  join sys_seg_submodulos b on a.sys_seg_modulos_id = b.sys_seg_modulos_id\n  join sys_seg_funciones c on b.sys_seg_submodulos_id = c.sys_seg_submodulos_id\n  join sys_seg_perfiles_has_funciones d on c.sys_seg_funciones_id = d.sys_seg_funciones_id\n  join sys_seg_usuarios_has_perfiles e on d.sys_seg_perfiles_id = e.sys_seg_perfiles_id\nwhere a.estado = 1\n  and b.estado = 1\n  and (c.estado = 1 and c.visible_menu=1)\ngroup by c.sys_seg_funciones_id,c.nombre_funcion
