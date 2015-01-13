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
 * Mmi/Controller/Router/Config.php
 * @category   Mmi
 * @package    Mmi_Controller
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    1.0.0
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

/**
 * Konfiguracja routera
 * @category   Mmi
 * @package    Mmi_Controller
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */
class Mmi_Controller_Router_Config {

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
	 * @return Mmi_Controller_Router_Config
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
	 * Zwraca wszystkie skonfigurowane routy
	 * @return array
	 */
	public function getRoutes() {
		return $this->_data;
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
