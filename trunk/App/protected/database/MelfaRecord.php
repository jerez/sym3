<?php
/**
 * Auto generated by prado-cli.php on 2009-01-30 09:53:41.
 */
class MelfaRecord extends TActiveRecord
{
	const TABLE='configuracion_melfa';

	public $configuracion_melfa_id;
	public $nombre;
	public $direccion_ip;
	public $puerto;
	public $desplazamiento;
	public $velocidad;
	public $timeout;

	public static function finder($className=__CLASS__)
	{
		return parent::finder($className);
	}
}
?>