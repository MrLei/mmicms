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
 * Mmi/Config2.php
 * @category   Mmi
 * @package    Mmi_Application
 * @copyright  Copyright (c) 2010 HQSoft Mariusz Miłejko (http://www.hqsoft.pl)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    $Id$
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */

/**
 * Podstawowa konfiguracja aplikacji
 * @category   Mmi
 * @package    Mmi_Application
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */

class Mmi_Config2 extends Mmi_Config_Abstract {

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
	public $languages = array('pl');

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