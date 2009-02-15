<?php
Prado::using('System.Exceptions.TErrorHandler');
/**
 * Clase Sym3ErrorHandler.
 * 
 * @author Carlos Eduardo Jerez Paz
 * @link http://www.quider.net/
 * @copyright Copyright &copy; 2009 Quider
 * @version $Id: Sym3ErrorHandler.php Sat Jan 31 19:54:34 COT 2009 Carlos Eduardo 
 * @package SYM3
 */
class Sym3ErrorHandler extends TErrorHandler {
	
	/**
	 * Constructor === __construct
	 * descripcion_ctor
	 *
	 * @return Sym3ErrorHandler
	 */
	public function Sym3ErrorHandler()
	{
		parent::__construct();
	}
	/**
	 * Override de HandleExternal Error
	 *
	 * @param unknown_type $statusCode
	 * @param unknown_type $exception
	 */
	protected function handleExternalError($statusCode, $exception)
	{
		if(!headers_sent())
			header("HTTP/1.0 {$statusCode} {$exception->getMessage()}");
		
		parent::handleExternalError($statusCode, $exception);
	}
	
}

?>