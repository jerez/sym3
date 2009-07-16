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

	
	private $_texto="El propósito del proyecto SYM3 (Supervisión y manipulación Mitsubishi Melfa), estuvo enfocado en la implementación funcional de un sistema de manipulación y supervisión WEB,  para el Robot Mitsubishi Melfa RV-12 , delimitado por un alcance meramente académico, con el objeto de demostrar la viabilidad de este tipo de implementaciones y proveer una base y/o marco de referencia para futuras implementaciones o incluso complementar la solución desarrollada; el alcance definido comprende la manipulación y supervisión visual a través redes LAN, WAN o Internet, entendiendo como manipulación el  envío de comandos de  movimiento en tiempo real y la posibilidad de ejecución de programas desde entornos remotos previamente cargados en la memoria de el robot, el BackEnd de la solución está desarrollado y enfocado hacia una plataforma  WEB, esto incluye un FrontEnd para acceso remoto al servidor a través de Browser (Web Based Application) y un cliente ligero que consume WebServices provistos por el BackEnd.
	\nEl potencial del proyecto se enfoca en proporcionar independencia geográfica entre el área física de acción del robot y el personal que va a actuar sobre esta área y resolver tareas críticas a través de herramientas de software que les permita tener acceso visual al entorno de trabajo del robot, teniendo en cuenta el crecimiento tecnológico de la industria y de los canales de información como Internet, y tratando de aprovechar al máximo estas herramientas con el mínimo de recursos y esfuerzos.
	\nLa arquitectura de la implementación de software, está dispuesta para la fácil integración de nuevos  componentes o complementos, lo que hace a SYM3 totalmente extensible y con un alto potencial de ser promovido a una plataforma para el desarrollo de sistemas SCADA y/o WBSC completos, a bajo costo, que fue uno de los objetivos planteados desde el inicio al proyecto. 
	\nTodas las herramientas usadas para el desarrollo y que hacen parte de la plataforma, así como librerías y componentes incluidos son Software Libre y como respeto a esta filosofía y su carácter académico y en pro de el desarrollo tecnológico, SYM3 hereda esta característica y se expone como un proyecto mas de software libre, con el anhelo de sus creadores de que continúe la evolución del proyecto tanto en manos propias como de otros a quienes interese.
	\n";
	
	
	function onLoad($param)	 {
		parent::onLoad($param);
		
		$this->Texto->Text= nl2br(htmlentities($this->_texto));
	}

}


?>