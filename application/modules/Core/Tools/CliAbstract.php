<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Core\Tools;

/**
 * Abstrakcyjna klasa narzędzia linii komend
 */
abstract class CliAbstract {

	/**
	 * Konstruktor konfiguruje środowisko dla linii komend
	 */
	public function __construct() {
		//powołanie i uruchomienie aplikacji
		$path = realpath(dirname(__FILE__) . '/../../../../');
		require $path . '/application/modules/Mmi/Application.php';

		$application = new \Mmi\Application($path, 'Cms\Application\BootstrapCli');
		$application->run();

		//ustawienie typu odpowiedzi na plain
		\Mmi\Controller\Front::getInstance()->getResponse()->setTypePlain();
	}
	
	/**
	 * Metoda uruchamiająca narzędzie
	 */
	abstract public function run();
	
	/**
	 * Uruchomienie metoda run() przy destrukcji klasy
	 */
	public function __destruct() {
		$this->run();
	}

}
