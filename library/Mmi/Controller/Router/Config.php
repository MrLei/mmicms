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
 * Mmi/Controller/Router/Config.php
 * @category   Mmi
 * @package    Mmi_Controller
 * @copyright  Copyright (c) 2010 HQSoft Mariusz Miłejko (http://www.hqsoft.pl)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    $Id$
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */

/**
 * Konfiguracja routera
 * @category   Mmi
 * @package    Mmi_Controller
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */
class Mmi_Controller_Router_Config extends Mmi_Config_Abstract {

	/**
	 * Dane rout
	 * @var type
	 */
	protected $_data = array();

	/**
	 * Tworzy (lub nadpisuje) routę
	 * @param string $name nazwa lub indeks
	 * @param string $pattern wyrażenie regularne lub plain
	 * @param array $replace tablica zastąpień
	 * @param array $default tablica wartości domyślnych
	 * @return \Mmi_Controller_Router_Config
	 */
	public function setRoute($name, $pattern, array $replace = array(), array $default = array()) {
		$route = new Mmi_Controller_Router_Config_Route();
		$route->name = $name;
		$route->pattern = $pattern;
		$route->replace = $replace;
		$route->default = $default;
		$this->_data[$name] = $route;
		return $this;
	}

	/**
	 * Pobierz routę
	 * @param string $name nazwa lub indeks
	 * @return Mmi_Controller_Router_Config_Route
	 */
	public function getRoute($name) {
		if (!$this->isRoute($name)) {
			return null;
		}
		return $this->_data[$name];
	}

	/**
	 * Sprawdza istnienie routy
	 * @param string $name nazwa lub indeks
	 * @return boolean
	 */
	public function isRoute($name) {
		return isset($this->_data[$name]);
	}

}
