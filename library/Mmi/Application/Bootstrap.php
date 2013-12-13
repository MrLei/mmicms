<?php

/**
 * Mmi
 *
 * LICENSE
 *
 * Ten plik źródłowy objęty jest licencją BSD bez klauzuli ogłoszeniowej.
 * Licencja jest dostępna pod adresem: http://www.hqsoft.pl/new-bsd
 * W przypadku problemów, prosimy o kontakt na adres office@hqsoft.pl
 *
 * Mmi/Application/Bootstrap.php
 * @category   Mmi
 * @package    Mmi_Application
 * @copyright  Copyright (c) 2010 HQSoft Mariusz Miłejko (http://www.hqsoft.pl)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    $Id$
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */

/**
 * Przykładowy bootstrap aplikacji
 * @category   Mmi
 * @package    Mmi_Application
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */
final class Mmi_Application_Bootstrap implements Mmi_Application_Bootstrap_Interface {

	/**
	 * Przykładowa konfiguracja o mizernej wydajności
	 */
	public function __construct() {
		Mmi_Profiler::event('Bootstrap started');

		//przykładowy pusty router
		$routerConfig = new Mmi_Controller_Router_Config();
		$router = new Mmi_Controller_Router($routerConfig);

		//konfiguracja widoku
		$view = new Mmi_View();
		$view->setBaseUrl($router->getBaseUrl())
			->setAlwaysCompile(true)
			->setDebug(true);

		//konfiguracja frontu
		Mmi_Controller_Front::getInstance()
			->setStructure(Mmi_Structure::getStructure())
			->setRouter($router)
			->setView($view);

		Mmi_Profiler::event('Front structure loaded');
	}

	/**
	 * Uruchomienie bootstrapa skutkuje uruchomieniem front kontrolera
	 */
	public function run() {
		Mmi_Controller_Front::getInstance()->dispatch();
	}

}
