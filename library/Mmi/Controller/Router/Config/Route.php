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
 * Mmi/Controller/Router/Config/Route.php
 * @category   Mmi
 * @package    Mmi_Controller
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    1.0.0
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

/**
 * Konfiguracja pojedynczej routy
 * @category   Mmi
 * @package    Mmi_Controller
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

class Mmi_Controller_Router_Config_Route {

	/**
	 * Nazwa routy (unikalna)
	 * @var string
	 */
	public $name;

	/**
	 * Wyrażenie regularne, lub czysty tekst, np.:
	 * /^hit\/(.[^\/]+)/
	 * witaj/potwierdzenie
	 * @var string
	 */
	public $pattern;

	/**
	 * Tabela zastąpień, np.:
	 * array('module' => 'news', 'controller' => 'index', 'action' => 'index');
	 * @var array
	 */
	public $replace = array();

	/**
	 * Tabela wartości domyślnych, np.:
	 * array('lang' => 'pl');
	 * @var array
	 */
	public $default = array();

}