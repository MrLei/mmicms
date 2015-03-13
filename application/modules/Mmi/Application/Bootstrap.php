<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Mmi\Application;

final class Bootstrap implements BootstrapInterface {

	/**
	 * Przykładowa konfiguracja o mizernej wydajności
	 */
	public function __construct() {
		//przykładowy pusty router
		$routerConfig = new \Mmi\Controller\Router\Config();
		$router = new \Mmi\Controller\Router($routerConfig);

		//konfiguracja widoku
		$view = new \Mmi\View();
		$view->setBaseUrl($router->getBaseUrl())
			->setAlwaysCompile(true);

		//konfiguracja frontu
		\Mmi\Controller\Front::getInstance()
			->setStructure(\Mmi\Structure::getStructure())
			->setRouter($router)
			->setView($view)
			->getResponse()->setDebug();

		\Mmi\Profiler::event('Bootstrap: front structure loaded');
	}

	/**
	 * Uruchomienie bootstrapa skutkuje uruchomieniem front kontrolera
	 */
	public function run() {
		\Mmi\Controller\Front::getInstance()->dispatch();
	}

}
