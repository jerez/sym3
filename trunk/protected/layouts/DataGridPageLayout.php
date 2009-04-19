<?php
/**
 * Clase DatagridBasePage.
 * Refactoring
 * Se crea para generar el Layout común a paginad con datagrid
 * 
 * @author Carlos Eduardo Jerez Paz
 * @link http://www.quider.net/
 * @copyright Copyright &copy; 2009 Quider
 * @version $Id: DatagridBasePage.php Fri Feb 06 02:54:44 COT 2009 Carlos Eduardo 
 * @package SYM3.Layouts
 */
class DataGridPageLayout extends TTemplateControl
{
	/**
	 * Por defecto en true, 
	 * solo deshabilitar EN LAS PAGINAS QUE IMPLEMENTE ESTE TEMPLATE si no se desean incluir los js de validación
	 * NO DEBE CAMBIARSE NUNCA EL VALOR EN ESTE SCRIPT
	 *
	 * @var BOOL
	 */
	public $Validar = true;
}

?>