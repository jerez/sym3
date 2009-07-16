<?php
/**
 * Clase Home.
 * 
 * @author Carlos Eduardo Jerez Paz
 * @link http://www.quider.net/
 * @copyright Copyright &copy; 2009 Quider
 * @version $Id: Home.php Mon Jan 26 21:32:11 COT 2009 Carlos Eduardo 
 * @package SYM3
 */
class Home extends TPage {

	
	private $_texto="El prop�sito del proyecto SYM3 (Supervisi�n y manipulaci�n Mitsubishi Melfa), estuvo enfocado en la implementaci�n funcional de un sistema de manipulaci�n y supervisi�n WEB,  para el Robot Mitsubishi Melfa RV-12 , delimitado por un alcance meramente acad�mico, con el objeto de demostrar la viabilidad de este tipo de implementaciones y proveer una base y/o marco de referencia para futuras implementaciones o incluso complementar la soluci�n desarrollada; el alcance definido comprende la manipulaci�n y supervisi�n visual a trav�s redes LAN, WAN o Internet, entendiendo como manipulaci�n el  env�o de comandos de  movimiento en tiempo real y la posibilidad de ejecuci�n de programas desde entornos remotos previamente cargados en la memoria de el robot, el BackEnd de la soluci�n est� desarrollado y enfocado hacia una plataforma  WEB, esto incluye un FrontEnd para acceso remoto al servidor a trav�s de Browser (Web Based Application) y un cliente ligero que consume WebServices provistos por el BackEnd.
	\nEl potencial del proyecto se enfoca en proporcionar independencia geogr�fica entre el �rea f�sica de acci�n del robot y el personal que va a actuar sobre esta �rea y resolver tareas cr�ticas a trav�s de herramientas de software que les permita tener acceso visual al entorno de trabajo del robot, teniendo en cuenta el crecimiento tecnol�gico de la industria y de los canales de informaci�n como Internet, y tratando de aprovechar al m�ximo estas herramientas con el m�nimo de recursos y esfuerzos.
	\nLa arquitectura de la implementaci�n de software, est� dispuesta para la f�cil integraci�n de nuevos  componentes o complementos, lo que hace a SYM3 totalmente extensible y con un alto potencial de ser promovido a una plataforma para el desarrollo de sistemas SCADA y/o WBSC completos, a bajo costo, que fue uno de los objetivos planteados desde el inicio al proyecto. 
	\nTodas las herramientas usadas para el desarrollo y que hacen parte de la plataforma, as� como librer�as y componentes incluidos son Software Libre y como respeto a esta filosof�a y su car�cter acad�mico y en pro de el desarrollo tecnol�gico, SYM3 hereda esta caracter�stica y se expone como un proyecto mas de software libre, con el anhelo de sus creadores de que contin�e la evoluci�n del proyecto tanto en manos propias como de otros a quienes interese.
	\n";
	
	
	function onLoad($param)	 {
		parent::onLoad($param);
		
		$this->Texto->Text= nl2br(htmlentities($this->_texto));
	}

}


?>