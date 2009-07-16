<?php
/**
 * FechasMysql, Clase para manipulación de fechas en Mysql
 *
 * @author Carlos Jerez <cjerezp@quider.net>
 * @link http://www.quider.net/
 * @version $Id: 1
 * @package SYM3.Utilidades
 */
class FechasMysql
{
	const  _formatoTimeStampMysql='Y-m-d H:i:s';
	const  _formatoFechaMysql='Y-m-d';
	const  _formatoHoraMysql='H:i:s';
	const  _separadorFechaHoraMysql=' ';
	const  _separadorFechaMysql='-';
	const  _separadorHoraMysql=':';
	const  _pocisionFechaEnTimestamp=0;
	const  _pocisionHoraEnTimestamp=1;
	const  _zonaUtc='America/Bogota';
	const  _zonaIdioma='esl';


	/**
    * Convierte el timestamp de unix a timestamp de mysql
    *
    * @param int[optional] timestamp de unix por defecto el actual
    * @return string timestamp de Mysql con formato FechasMysql::_formatoTimeStampMysql
    */
	public static function MySqlTimeStamp($unixTimestamp=null)
	{
		FechasMysql::ConfigurarZona();

		if ($unixTimestamp===null)
		$unixTimestamp=time();

		return date(FechasMysql::_formatoTimeStampMysql,$unixTimestamp);
	}

	/**
    * Convierte el timestamp de unix a time de mysql
    *
    * @param[optional] int timestamp de unix por defecto el actual
    * @return string time de Mysql con formato 'H:i:s'
    */
	public static function MySqlTime($unixTimestamp=null)
	{
		FechasMysql::ConfigurarZona();

		if ($unixTimestamp===null)
		$unixTimestamp=time();

		return date(FechasMysql::_formatoHoraMysql,$unixTimestamp);
	}

	/**
    * Convierte el timestamp de unix a date de mysql
    *
    * @param int[optional] timestamp de unix por defecto el actual
    * @return string date de Mysql con formato 'Y-m-d '
    */
	public static function MySqlDate($unixTimestamp=null)
	{
		FechasMysql::ConfigurarZona();

		if ($unixTimestamp===null)
		$unixTimestamp=time();

		return date(FechasMysql::_formatoFechaMysql,$unixTimestamp);
	}

	/**
    * Obtiene El string de la fecha
    *
    * @param int[optional] timestamp de unix por defecto el actual
    * @param string[optional] opcion si 'F' retorna la fecha, por defecto; de lo contrario Fecha y Hora
    * @return string fecha o fecha y hora en una cadena
    */
	public static function ObtenerStringFechaUnix($unixTimestamp=null,$opcionString='F')
	{
		FechasMysql::ConfigurarZona();

		if ($unixTimestamp===null)
		$unixTimestamp=time();

		if ($opcionString=='F')
		return strftime(' %A, %d de %B de %Y.' ,$unixTimestamp);
		else
		return strftime(' %H:%M  del %A, %d de %B de %Y.' ,$unixTimestamp);

	}

	/**
    * Obtiene El string de la fecha
    *
    * @param String[optional] timestamp de Mysql por defecto el actual
    * @param string[optional] opcion si 'F' retorna la fecha, por defecto; de lo contrario Fecha y Hora
    * @return string fecha o fecha y hora en una cadena
    */
	public static function ObtenerStringFechaMysql($mysqlTimeStamp=null,$opcionString='F')
	{
		if ($mysqlTimeStamp===null)
		$mysqlTimeStamp=date(FechasMysql::_formatoTimeStampMysql);

		$unixTimestamp=FechasMysql::UnixTimeStamp($mysqlTimeStamp);
		return FechasMysql::ObtenerStringFechaUnix($unixTimestamp,$opcionString);
	}


	/**
    * Convierte el timestamp de mysql a timestamp de unix
    *
    * @param string timestamp de Mysql con formato 'Y-m-d H:i:s' por defecto el actual
    * @return int timestamp de unix
    */
	public static function UnixTimeStamp($mysqlTimeStamp)
	{
		FechasMysql::ConfigurarZona();

		$arrayTimestamp=explode(FechasMysql::_separadorFechaHoraMysql, $mysqlTimeStamp);
		$arrayFecha	= explode(FechasMysql::_separadorFechaMysql,$arrayTimestamp[FechasMysql::_pocisionFechaEnTimestamp]);
		$arrayHora=explode(FechasMysql::_separadorHoraMysql,$arrayTimestamp[FechasMysql::_pocisionHoraEnTimestamp]);

		return $unixTimesTamp = mktime($arrayHora[0],$arrayHora[1],$arrayHora[2],$arrayFecha[1],$arrayFecha[2],$arrayFecha[0]);
	}

	/**
    * Convierte el timestamp de mysql a timestamp de unix
    *
    * @param string Date de Mysql con formato 'Y-m-d'
    * @return int timestamp de unix
    */
	public static function Date2UnixTimeStamp($mysqlDate)
	{
		FechasMysql::ConfigurarZona();

		$arrayFecha	= explode(FechasMysql::_separadorFechaMysql,$mysqlDate);

		return $unixTimesTamp = mktime(0,0,0,$arrayFecha[1],$arrayFecha[2],$arrayFecha[0]);
	}

	private static function ConfigurarZona()
	{
		//se asegura que la zona horaria adecuada
		date_default_timezone_set(FechasMysql::_zonaUtc);
		//Pone el idioma
		setlocale(LC_TIME,FechasMysql::_zonaIdioma);
	}

	public static function date_diff($d1, $d2){
		$d1 = (is_string($d1) ? strtotime($d1) : $d1);
		$d2 = (is_string($d2) ? strtotime($d2) : $d2);

		$diff_secs = abs($d1 - $d2);
		$base_year = min(date("Y", $d1), date("Y", $d2));

		$diff = mktime(0, 0, $diff_secs, 1, 1, $base_year);
		return array(
		"years" => date("Y", $diff) - $base_year,
		"months_total" => (date("Y", $diff) - $base_year) * 12 + date("n", $diff) - 1,
		"months" => date("n", $diff) - 1,
		"days_total" => floor($diff_secs / (3600 * 24)),
		"days" => date("j", $diff) - 1,
		"hours_total" => floor($diff_secs / 3600),
		"hours" => date("G", $diff),
		"minutes_total" => floor($diff_secs / 60),
		"minutes" => (int) date("i", $diff),
		"seconds_total" => $diff_secs,
		"seconds" => (int) date("s", $diff)
		);
	}


}


?>