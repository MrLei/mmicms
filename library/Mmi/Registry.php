<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Mmi;

abstract class Registry {

	/**
	 * Konfiguracja aplikacji
	 * @var \Mmi\Config
	 */
	public static $config;

	/**
	 * Tablica ze zmiennymi użytkownika
	 * @var array
	 */
	protected static $_userData = array();

	/**
	 * Ustawia zmienną użytkownika
	 * @param string $key
	 * @param mixed $value
	 * @return mixed
	 */
	public static function setVar($key, $value) {
		return static::$_userData[$key] = $value;
	}

	/**
	 * Kasuje zmienną użytkownika
	 * @param string $key
	 */
	public static function unsetVar($key) {
		unset(static::$_userData[$key]);
	}

	/**
	 * Zwraca zmienną użytkownika
	 * @param string $key
	 * @return mixed
	 */
	public static function getVar($key) {
		return isset(static::$_userData[$key]) ? static::$_userData[$key] : null;
	}

	/**
	 * Sprawdza istnienie zmiennej użytkownika
	 * @param string $key
	 * @return boolean
	 */
	public static function issetVar($key) {
		return array_key_exists($key, static::$_userData);
	}

	/**
	 * Zwraca wszystkie zmienne użytkownika w tablicy
	 * @return array
	 */
	public static function getAllVars() {
		return static::$_userData;
	}

}
