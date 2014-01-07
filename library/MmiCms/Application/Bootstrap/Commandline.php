<?php

/**
 * MmiCms
 *
 * LICENSE
 *
 * Ten plik źródłowy objęty jest licencją BSD bez klauzuli ogłoszeniowej.
 * Licencja jest dostępna pod adresem: http://www.hqsoft.pl/new-bsd
 * W przypadku problemów, prosimy o kontakt na adres office@hqsoft.pl
 *
 * MmiCms/Bootstrap/Cmd.php
 * @category   MmiCms
 * @package    MmiCms_Bootstrap
 * @copyright  Copyright (c) 2010 HQSoft Mariusz Miłejko (http://www.hqsoft.pl)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    $Id$
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */

/**
 * Klasa startu aplikacji command line
 * ustawia ścieżki, ładuje ogólną konfigurację
 * @category   Mmi
 * @package    Mmi_Bootstrap
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
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
		$request->setModuleName('default')
				->setControllerName('index')
				->setActionName('index')
				->setParam('lang', 'en')
				->setSkinName(Default_Registry::$config->application->skin);
		if (isset(Default_Registry::$config->application->languages[0])) {
			$request->setParam('lang', Default_Registry::$config->application->languages[0]);
		}
		//ustawianie żądania
		$front->setRequest($request);
		Mmi_Controller_Front::getInstance()->getView()->setRequest($request);
	}

}