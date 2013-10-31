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
 * Mmi/Controller/Router/Config/Route.php
 * @category   Mmi
 * @package    Mmi_Controller
 * @copyright  Copyright (c) 2010 HQSoft Mariusz Miłejko (http://www.hqsoft.pl)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    $Id$
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */

/**
 * Konfiguracja pojedynczej routy
 * @category   Mmi
 * @package    Mmi_Controller
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */

class Mmi_Controller_Router_Config_Route extends Mmi_Config_Abstract {

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