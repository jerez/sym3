TYPE=VIEW
query=select `e`.`sys_seg_usuarios_id` AS `sys_seg_usuarios_id`,`b`.`sys_seg_funciones_id` AS `sys_seg_funciones_id`,`a`.`sys_seg_recursos_id` AS `sys_seg_recursos_id`,`a`.`identificador_recurso` AS `identificador_recurso`,`a`.`es_principal` AS `es_principal` from `sym3`.`sys_seg_recursos` `a` join `sym3`.`sys_seg_funciones` `b` join `sym3`.`sys_seg_perfiles_has_funciones` `c` join `sym3`.`sys_seg_perfiles` `d` join `sym3`.`sys_seg_usuarios_has_perfiles` `e` where ((`a`.`sys_seg_funciones_id` = `b`.`sys_seg_funciones_id`) and (`b`.`sys_seg_funciones_id` = `c`.`sys_seg_funciones_id`) and (`c`.`sys_seg_perfiles_id` = `d`.`sys_seg_perfiles_id`) and (`d`.`sys_seg_perfiles_id` = `e`.`sys_seg_perfiles_id`) and (`a`.`estado` = 1) and (`b`.`estado` = 1) and (`d`.`estado` = 1))
md5=9724d07a4ff28b36df77d65c0496fafa
updatable=1
algorithm=0
definer_user=root
definer_host=localhost
suid=2
with_check_option=0
timestamp=2009-07-16 05:23:06
create-version=1
source=select e.sys_seg_usuarios_id,\n       b.sys_seg_funciones_id,\n       a.sys_seg_recursos_id,\n       a.identificador_recurso,\n       a.es_principal\nfrom  sys_seg_recursos a,\n      sys_seg_funciones b,\n      sys_seg_perfiles_has_funciones c,\n      sys_seg_perfiles d,\n      sys_seg_usuarios_has_perfiles e\nwhere a.sys_seg_funciones_id = b.sys_seg_funciones_id\n  and b.sys_seg_funciones_id = c.sys_seg_funciones_id\n  and c.sys_seg_perfiles_id = d.sys_seg_perfiles_id\n  and d.sys_seg_perfiles_id = e.sys_seg_perfiles_id\n  and a.estado=1\n  and b.estado=1\n  and d.estado=1
