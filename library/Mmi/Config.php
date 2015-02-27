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
 * @package    \Mmi\Config
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    1.0.0
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */
/**
 * Abstrakcyjna klasa konfiguracji Mmi
 * @category   Mmi
 * @package    \Mmi\Config
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

namespace Mmi;

abstract class Config {

	/**
	 * Podstawowa konfiguracja aplikacji
	 * @var \Mmi\Application\Config
	 */
	public $application;

	/**
	 * Konfiguracja postawowego cache
	 * @var \Mmi\Cache\Config
	 */
	public $cache;

	/**
	 * Konfiguracja routera
	 * @var \Mmi\Controller\Router\Config
	 */
	public $router;

	public function __construct() {

		$this->application = new \Mmi\Application\Config();
		$this->cache = new \Mmi\Cache\Config();
		$this->router = new \Mmi\Controller\Router\Config();
	}

}
