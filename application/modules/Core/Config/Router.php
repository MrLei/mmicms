<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Core\Config;

class Router extends \Mmi\Controller\Router\Config {

	/**
	 * Konstruktor konfigurujący router
	 */
	public function __construct() {

		//artykuły CMS
		$this->setRoute(1, '/^strona,(.[^\/]+)$/', array('module' => 'cms', 'controller' => 'article', 'action' => 'index', 'uri' => '$1'));
		$this->setRoute(2, '/^strona,(.[^\/]+)$/', array('module' => 'cms', 'controller' => 'article', 'action' => 'index', 'uri' => '$1'));

		//aktualności CMS
		$this->setRoute(10, 'aktualnosci', array('module' => 'cms', 'controller' => 'news'), array('action' => 'index'));
		$this->setRoute(11, '/^aktualnosci-([0-9]+)\/([0-9]+)/', array('module' => 'cms', 'controller' => 'news', 'action' => 'index', 'pages' => '$1', 'p' => '$2'));
		$this->setRoute(12, '/^aktualnosci-([0-9]+)/', array('module' => 'cms', 'controller' => 'news', 'action' => 'index', 'pages' => '$1'));
		$this->setRoute(13, '/^aktualnosci\/([0-9]+)/', array('module' => 'cms', 'controller' => 'news', 'action' => 'index', 'p' => '$1'));
		$this->setRoute(14, '/^aktualnosci,(.[^\/]+)/', array('module' => 'cms', 'controller' => 'news', 'action' => 'display', 'uri' => '$1'));
		
	}

}
