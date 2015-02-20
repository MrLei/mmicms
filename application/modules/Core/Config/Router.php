<?php

/**
 * Klasa konfiguracji routera
 */

namespace Core\Config;

class Router extends \Mmi\Controller\Router\Config {

	/**
	 * Konstruktor konfigurujący router
	 */
	public function __construct() {

		//strona główna
		$this->setRoute(0, '', array('module' => 'default'), array('controller' => 'index', 'action' => 'index'));
		
		//artykuły CMS
		$this->setRoute(1, '/^strona,(.[^\/]+)$/', array('module' => 'cms', 'controller' => 'article', 'action' => 'index', 'uri' => '$1'));
		$this->setRoute(2, '/^strona,(.[^\/]+)$/', array('module' => 'cms', 'controller' => 'article', 'action' => 'index', 'uri' => '$1'));

		//aktualności CMS
		$this->setRoute(10, 'aktualnosci', array('module' => 'cms', 'controller' => 'news', 'action' => 'index'));
		$this->setRoute(11, '/^aktualnosci-([0-9]+)\/([0-9]+)/', array('module' => 'cms', 'controller' => 'news', 'action' => 'index', 'pages' => '$1', 'p' => '$2'));
		$this->setRoute(12, '/^aktualnosci-([0-9]+)/', array('module' => 'cms', 'controller' => 'news', 'action' => 'index', 'pages' => '$1'));
		$this->setRoute(13, '/^aktualnosci\/([0-9]+)/', array('module' => 'cms', 'controller' => 'news', 'action' => 'index', 'p' => '$1'));
		$this->setRoute(14, '/^aktualnosci,(.[^\/]+)/', array('module' => 'cms', 'controller' => 'news', 'action' => 'display', 'uri' => '$1'));
	}

}
