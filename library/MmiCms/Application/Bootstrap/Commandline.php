<?php

/**
 * MmiCms
 *
 * LICENSE
 *
 * Ten plik źródłowy objęty jest licencją BSD bez klauzuli ogłoszeniowej.
 * Licencja jest dostępna pod adresem: http://milejko.com/new-bsd.txt
 * W przypadku problemów, prosimy o kontakt na adres mariusz@milejko.pl
 *
 * MmiCms/Bootstrap/Cmd.php
 * @category   MmiCms
 * @package    MmiCms\Bootstrap
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    1.0.0
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */
/**
 * Klasa startu aplikacji command line
 * ustawia ścieżki, ładuje ogólną konfigurację
 * @category   Mmi
 * @package    \Mmi\Bootstrap
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

namespace MmiCms\Application\Bootstrap;

class Commandline extends \MmiCms\Application\Bootstrap {

	public function __construct() {

		parent::__construct();
	}

	/**
	 * Uruchamianie bootstrapa - brak front kontrolera
	 */
	public function run() {
		$front = \Mmi\Controller\Front::getInstance();
		$request = new \Mmi\Controller\Request();
		//ustawianie domyślnego języka jeśli istnieje
		if (isset(\Core\Registry::$config->application->languages[0])) {
			$request->setParam('lang', \Core\Registry::$config->application->languages[0]);
		}
		$request->setModuleName('default')
			->setControllerName('index')
			->setActionName('index')
			->setSkinName(\Core\Registry::$config->application->skin);
		//ustawianie żądania
		$front->setRequest($request);
		\Mmi\Controller\Front::getInstance()->getView()->setRequest($request);
	}

}
