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
 * Mmi/Application_Config.php
 * @category   Mmi
 * @package    Mmi_Application
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    1.0.0
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

/**
 * Podstawowa konfiguracja aplikacji
 * @category   Mmi
 * @package    Mmi_Application
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

class Mmi_Application_Config {

	/**
	 * Charset
	 * @var string
	 */
	public $charset = 'utf-8';

	/**
	 * Tryb debugowania
	 * @var boolean
	 */
	public $debug = false;

	/**
	 * Bezwarunkowa kompilacja
	 * @var boolean
	 */
	public $compile = true;

	/**
	 * Strefa czasowa
	 * @var string
	 */
	public $timeZone = 'Europe/Warsaw';

	/**
	 * Nazwa skóry
	 * @var string
	 */
	public $skin = 'default';

	/**
	 * Globalna sól aplikacji
	 * @var string
	 */
	public $salt = 'change-this-value';

	/**
	 * Języki obsługiwane przez aplikację
	 * np. pl, en, fr
	 * @var array
	 */
	public $languages = array();

	/**
	 * Pluginy włączone w aplikacji
	 * np. MmiTest_Controller_Plugin
	 * @var array
	 */
	public $plugins = array();

	/**
	 * Domyślny host, jeśli nie ustawiony
	 * @var string
	 */
	public $host;

}