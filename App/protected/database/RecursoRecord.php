<?php
/**
 * Auto generated by prado-cli.php on 2009-01-30 09:35:57.
 */
class RecursoRecord extends TActiveRecord
{
	const TABLE='sys_seg_recursos';

	public $sys_seg_recursos_id;
	public $sys_seg_funciones_id;
	public $identificador_recurso;
	public $es_principal;
	public $estado;

	public static $RELATIONS=array
	(
		'funcion' => array(self::BELONGS_TO, 'FuncionRecord', 'sys_seg_funciones_id'),
	);

	public static function finder($className=__CLASS__)
	{
		return parent::finder($className);
	}
}
?>