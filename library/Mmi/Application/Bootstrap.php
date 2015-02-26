<?php

/**
 * Mmi
 *
 * LICENSE
 *
 * Ten plik źródłowy objęty jest licencją BSD bez klauzuli ogłoszeniowej.
 * Licencja jest dostępna pod adresem: http://milejko.com/new-bsd.txt
 * W przypadku problemów, prosimy o kontakt na adres mariusz@milejko.pl
 *
 * Mmi/Application/Bootstrap.php
 * @category   Mmi
 * @package    \Mmi\Application
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    1.0.0
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */
/**
 * Przykładowy bootstrap aplikacji
 * @category   Mmi
 * @package    \Mmi\Application
 * @license    http://milejko.com/new-bsd.txt     New BSD License
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

		\Mmi\Profiler::event('Front structure loaded');
	}

	/**
	 * Uruchomienie bootstrapa skutkuje uruchomieniem front kontrolera
	 */
	public function run() {
		\Mmi\Controller\Front::getInstance()->dispatch();
	}

}
