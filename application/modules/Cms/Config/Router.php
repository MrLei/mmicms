<?php

/**
 * Klasa konfiguracji routera
 */

namespace Cms\Config;

class Router extends \Mmi\Controller\Router\Config {

	public function __construct() {
		
		//strona główna moduł core + kontroler index + akcja index
		$this->setRoute(110000, '/^$/', array('module' => 'core'), array('controller' => 'index', 'action' => 'index'));
		
		//moduł + kontroler index + akcja index np. /cms
		$this->setRoute(110001, '/^([a-zA-Z]+)$/', array('module' => '$1'), array('controller' => 'index', 'action' => 'index'));
		
		//moduł + kontroler + akcja index np. /cms/article
		$this->setRoute(110002, '/^([a-zA-Z]+)\/([a-zA-Z\-]+)$/', array('module' => '$1', 'controller' => '$2'), array('action' => 'index'));
		
		//moduł + kontroler + akcja np. /cms/article/display
		$this->setRoute(110003, '/^([a-zA-Z]+)\/([a-zA-Z\-]+)\/([a-zA-Z]+)$/', array('module' => '$1', 'controller' => '$2', 'action' => '$3'));
		
	}

}
