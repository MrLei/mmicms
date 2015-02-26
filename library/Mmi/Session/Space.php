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
 * Mmi/Session/Space.php
 * @category   Mmi
 * @package    \Mmi\Session
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    1.0.0
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */
/**
 * Klasa obsługi przestrzeni nazw w sesji użytkownika
 * @category   Mmi
 * @package    \Mmi\Session
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

namespace Mmi\Session;

class Space {

	/**
	 * Nazwa przestrzeni
	 * @var string
	 */
	private $_namespace;

	/**
	 * Konstruktor, ustawia nazwę przestrzeni
	 * @param string $namespace nazwa przestrzeni
	 */
	public function __construct($namespace) {
		$this->_namespace = $namespace;
	}

	/**
	 * Magicznie ustawia zmienną w przestrzeni
	 * @param string $key klucz
	 * @param string $value wartość
	 */
	public function __set($key, $value) {
		if (!isset($_SESSION[$this->_namespace]) || !is_array($_SESSION[$this->_namespace])) {
			$_SESSION[$this->_namespace] = array();
		}
		$_SESSION[$this->_namespace][$key] = $value;
	}

	/**
	 * Magicznie pobiera zmienną z przestrzeni
	 * @param string $key klucz
	 * @return mixed
	 */
	public function __get($key) {
		return isset($_SESSION[$this->_namespace][$key]) ? $_SESSION[$this->_namespace][$key] : null;
	}

	/**
	 * Magicznie sprawdza istnienie zmiennej
	 * @param string $key klucz
	 * @return boolean
	 */
	public function __isset($key) {
		return isset($_SESSION[$this->_namespace][$key]);
	}

	/**
	 * Magicznie usuwa zmienną z przestrzeni
	 * @param string $key klucz
	 */
	public function __unset($key) {
		unset($_SESSION[$this->_namespace][$key]);
	}

	/**
	 * Usuwa wszystkie zmienne
	 */
	public function unsetAll() {
		unset($_SESSION[$this->_namespace]);
	}

}
