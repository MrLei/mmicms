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
 * @package    MmiCms_Bootstrap
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    1.0.0
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

/**
 * Klasa startu aplikacji command line
 * ustawia ścieżki, ładuje ogólną konfigurację
 * @category   Mmi
 * @package    Mmi_Bootstrap
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */
class MmiCms_Application_Bootstrap_Commandline extends MmiCms_Application_Bootstrap {

	public function __construct() {

		parent::__construct();

	}

	/**
	 * Uruchamianie bootstrapa - brak front kontrolera
	 */
	public function run() {
		$front = Mmi_Controller_Front::getInstance();
		$request = new Mmi_Controller_Request();
		//ustawianie domyślnego języka jeśli istnieje
		if (isset(Default_Registry::$config->application->languages[0])) {
			$request->setParam('lang', Default_Registry::$config->application->languages[0]);
		}
		$request->setModuleName('default')
				->setControllerName('index')
				->setActionName('index')
				->setSkinName(Default_Registry::$config->application->skin);
		//ustawianie żądania
		$front->setRequest($request);
		Mmi_Controller_Front::getInstance()->getView()->setRequest($request);
	}

}