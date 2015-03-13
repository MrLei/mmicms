<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Mmi;

abstract class Config {

	/**
	 * Podstawowa konfiguracja aplikacji
	 * @var \Mmi\Application\Config
	 */
	public $application;

	/**
	 * Konfiguracja postawowego cache
	 * @var \Mmi\Cache\Config
	 */
	public $cache;

	/**
	 * Konfiguracja routera
	 * @var \Mmi\Controller\Router\Config
	 */
	public $router;

	public function __construct() {

		$this->application = new \Mmi\Application\Config();
		$this->cache = new \Mmi\Cache\Config();
		$this->router = new \Mmi\Controller\Router\Config();
	}

}
