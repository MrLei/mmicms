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
 * Mmi/Config.php
 * @category   Mmi
 * @package    Mmi_Config
 * @copyright  Copyright (c) 2010 HQSoft Mariusz Miłejko (http://www.hqsoft.pl)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    $Id$
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */

/**
 * Abstrakcyjna klasa konfiguracji Mmi
 * @category   Mmi
 * @package    Mmi_Config
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */
abstract class Mmi_Config {

	/**
	 * Podstawowa konfiguracja aplikacji
	 * @var Mmi_Application_Config
	 */
	public $application;

	/**
	 * Konfiguracja postawowego cache
	 * @var Mmi_Cache_Config
	 */
	public $cache;

	/**
	 * Konfiguracja routera
	 * @var Mmi_Controller_Router_Config
	 */
	public $router;

	public function __construct() {

		$this->application = new Mmi_Application_Config();
		$this->cache = new Mmi_Cache_Config();
		$this->router = new Mmi_Controller_Router_Config();
	}

}
