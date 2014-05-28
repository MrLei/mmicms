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
 * Mmi/Config.php
 * @category   Mmi
 * @package    Mmi_Config
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    1.0.0
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

/**
 * Abstrakcyjna klasa konfiguracji Mmi
 * @category   Mmi
 * @package    Mmi_Config
 * @license    http://milejko.com/new-bsd.txt     New BSD License
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
