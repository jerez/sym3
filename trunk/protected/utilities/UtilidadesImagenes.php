<?php
/**
 * Clase Utilidades.
 *
 * @author Carlos Eduardo Jerez Paz
 * @link http://www.quider.net/
 * @copyright Copyright &copy; 2009 Quider
 * @version $Id: Utilidades.php Mon Jan 26 22:11:02 COT 2009 Carlos Eduardo 
 * @package SYM3.Utilidades
 */
class UtilidadesImagenes{

	/**
    * Publica cualquier imagen en Assets para hacerla visible
    *
    * @param String nombre de la imagen
    * @return string Url de la imagen publicada
    */
	public static function PublicarImagen($nombreImagen)
	{
		return UtilidadesImagenes::PublicarImagenAlias('Imagenes',$nombreImagen);
	}

	/**
    * Publica cualquier imagen en Assets para hacerla visible
    *
    * @param String Path completo de la imagen
    * @return string Url de la imagen publicada
    */
	public static function PublicarImagenPath($pathImagen)
	{

		$assetManager=Prado::getApplication()->getAssetManager();
		if (strtolower(filetype($pathImagen))!='dir') {
			$url=$assetManager->publishFilePath($pathImagen);
		}
		else
		{
			throw new Exception('No Es Archivo');
		}
		return $url;
	}


	/**
    * Publica cualquier imagen en Assets para hacerla visible
    *
    * @param string  Namespace donde se encuentra almacenada originalmente
    * @param string Nombre del archivo
    * @return string Url de la imagen publicada
    */
	public static function PublicarImagenNamespace($namespace,$nombreImagen)
	{

		if (UtilidadesImagenes::EndsWith($namespace,'.') )
		$path=Prado::getPathOfNamespace($namespace,$nombreImagen);
		else
		$path=Prado::getPathOfNamespace($namespace).DIRECTORY_SEPARATOR.$nombreImagen;

		return UtilidadesImagenes::PublicarImagenPath($path);
	}

	/**
    * Publica cualquier imagen en Assets para hacerla visible
    *
    * @param string  Namespace donde se encuentra almacenada originalmente
    * @param string Nombre del archivo
    * @return string Url de la imagen publicada
    */
	public static function PublicarImagenAlias($alias,$nombreImagen)
	{

		$path=Prado::getPathOfAlias($alias).DIRECTORY_SEPARATOR.$nombreImagen;
		return UtilidadesImagenes::PublicarImagenPath($path);
	}


	/**
    * Determina si una cadena termina con una subcadena determinada
    *
    * @param string Cadena Evaluada
    * @param string subcadena a evaluar
    * @return bool true si $str termina en $sub
    */
	private static  function EndsWith( $str, $sub ) {
		return ( substr( $str, strlen( $str ) - strlen( $sub ) ) == $sub );
	}
}


?>