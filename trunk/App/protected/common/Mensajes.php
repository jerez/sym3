<?php

/**
 * Clase Mensajes.
 *
 * @author Carlos Eduardo Jerez Paz
 * @link http://www.quider.net/
 * @copyright Copyright &copy; 2009 Quider
 * @version $Id: Mensajes.php Mon Feb 09 00:20:50 COT 2009 Carlos Eduardo 
 * @package SYM3.common
 * @todo Realizar implementacion completa de las clases para que el manejo se mensajes
 * se realice a travez de enumeraciones.
 */
class Mensajes{


	protected static $_arrayMensajes = array(
	'SinRecurso' => array( 'id'=>1,'mensaje'=>'No hay recursos Asociados a la funci&oacute;n seleccionada'),
	'Prueba' => array( 'id'=>2,'mensaje'=>'Este es solo de prueba'),

	);

	private $_arrayIntancias;

	/**
	 * mantiene la instancia de la clase class
	 *
	 */
	private static $instance;

	/**
     * Contructor Privado; Previene la creación directa del objeto
     *
     */
	private function __construct(){

		foreach (Mensajes::$_arrayMensajes as $key => $value) {
			$instancia = new Mensaje($value['id'],$key,$value['mensaje']);
			/**
			 * Se copian dos veces apra obtenerlo por nombre o Id
			 * @todo  esto debe corregirse y optimizarse a travez de enumeraciones.
			 */
			$this->_arrayIntancias[$key] = $instancia;
			$this->_arrayIntancias[$value['id']] = $instancia;
		}
	}

	/**
     * Metodo Fabrica para retornar el Singleton
     *
     * @return unknown
     */
	public static function Singleton()
	{
		if (!isset(self::$instance)) {
			$class = __CLASS__;
			self::$instance = new $class;
		}

		return self::$instance;
	}

	/**
     * Previene la clonacion de la instancia
     *
     */
	public function __clone(){
		trigger_error('Clonacion no Permitida.', E_USER_ERROR);
	}

	/**
     * Retorna el mensaje de Forma HardCoded
     *
     * @param string $nombre
     * @return Mensaje
     */
	public function __get( /*string*/ $nombre = null ) {
		return $this->_arrayIntancias[$nombre];
	}

	/**
	 * Retorna la instancia del mensaje a partir de el Id
     * @param int $id
	 * @return Mensaje
	 */
	public function GetById($id){
		return $this->_arrayIntancias[$id];
	}


}


/**
 * Clase Mensaje, se comporta como una estructura que contiene los valores de Id
 * nombre y mensaje para cada mensaje
 *
 */
class Mensaje{
	private $_id;
	private $_nombre;
	private $_mensaje;

	public function __construct($id,$nombre,$mensaje){
		$this->_id = $id;
		$this->_nombre = $nombre;
		$this->_mensaje = $mensaje;
	}
	
	public function getId(){
		return $this->_id;
	}

	public function __toString(){
		return $this->_mensaje;
	}

}

/**
 * @todo Realizar implementacion completa de las clases para que el manejo se mensajes
 * se realice a travez de enumeraciones.
 *
 */
class Enum {
	protected $self = array();
	public function __construct( /*...*/ ) {
		$args = func_get_args();
		for( $i=0, $n=count($args); $i<$n; $i++ )
		$this->add($args[$i]);
	}

	public function __get( /*string*/ $name = null ) {
		return $this->self[$name];
	}

	public function add( /*string*/ $name = null, /*int*/ $enum = null ) {
		if( isset($enum) )
		$this->self[$name] = $enum;
		else
		$this->self[$name] = end($this->self) + 1;
	}
}
class DefinedEnum extends Enum {
	public function __construct( /*array*/ $itms ) {
		foreach( $itms as $name => $enum )
		$this->add($name, $enum);
	}
}

?>