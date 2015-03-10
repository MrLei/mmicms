<?php

/**
 * Klasa konfiguracji routera
 */

namespace Cms\Config;

class Router extends \Mmi\Controller\Router\Config {

	public function __construct() {
		
		//strona główna: /
		$this->setRoute(110000, '/^$/', array('module' => 'core'), array('controller' => 'index', 'action' => 'index'));
		
		//moduł (index/index): /news
		$this->setRoute(110001, '/^([a-z]+)$/', array('module' => '$1'), array('controller' => 'index', 'action' => 'index'));
		
		//moduł + kontroler + akcja index: /news/article
		$this->setRoute(110002, '/^([a-z]+)\/([a-z\-]+)$/', array('module' => '$1', 'controller' => '$2'), array('action' => 'index'));
		
		//moduł + kontroler + akcja: /news/article/display
		$this->setRoute(110003, '/^([a-z]+)\/([a-z\-]+)\/([a-z]+)$/', array('module' => '$1', 'controller' => '$2', 'action' => '$3'));
		
	}

}
