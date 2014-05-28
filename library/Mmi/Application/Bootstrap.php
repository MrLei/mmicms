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
 * @package    Mmi_Application
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    1.0.0
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

/**
 * Przykładowy bootstrap aplikacji
 * @category   Mmi
 * @package    Mmi_Application
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */
final class Mmi_Application_Bootstrap implements Mmi_Application_Bootstrap_Interface {

	/**
	 * Przykładowa konfiguracja o mizernej wydajności
	 */
	public function __construct() {
		//przykładowy pusty router
		$routerConfig = new Mmi_Controller_Router_Config();
		$router = new Mmi_Controller_Router($routerConfig);

		//konfiguracja widoku
		$view = new Mmi_View();
		$view->setBaseUrl($router->getBaseUrl())
			->setAlwaysCompile(true);

		//konfiguracja frontu
		Mmi_Controller_Front::getInstance()
			->setStructure(Mmi_Structure::getStructure())
			->setRouter($router)
			->setView($view)
			->getResponse()->setDebug();

		Mmi_Profiler::event('Front structure loaded');
	}

	/**
	 * Uruchomienie bootstrapa skutkuje uruchomieniem front kontrolera
	 */
	public function run() {
		Mmi_Controller_Front::getInstance()->dispatch();
	}

}
