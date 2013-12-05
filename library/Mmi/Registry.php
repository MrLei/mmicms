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
 * Mmi/Registry.php
 * @category   Mmi
 * @package    Mmi_Registry
 * @copyright  Copyright (c) 2010 HQSoft Mariusz Miłejko (http://www.hqsoft.pl)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    $Id$
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */

/**
 * Klasa rejestru
 * @category   Mmi
 * @package    Mmi_Registry
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */
abstract class Mmi_Registry {

	/**
	 * Konfiguracja aplikacji
	 * @var Mmi_Config
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
	public static function setUserVariable($key, $value) {
		return static::$_userData[$key] = $value;
	}

	/**
	 * Kasuje zmienną użytkownika
	 * @param string $key
	 */
	public static function unsetUserVariable($key) {
		unset(static::$_userData[$key]);
	}

	/**
	 * Zwraca zmienną użytkownika
	 * @param string $key
	 * @return mixed
	 */
	public static function getUserVariable($key) {
		return isset(static::$_userData[$key]) ? static::$_userData[$key] : null;
	}

	/**
	 * Sprawdza istnienie zmiennej użytkownika
	 * @param string $key
	 * @return boolean
	 */
	public static function issetUserVariable($key) {
		return array_key_exists($key, static::$_userData);
	}

	/**
	 * Zwraca wszystkie zmienne użytkownika w tablicy
	 * @return array
	 */
	public static function getAllUserVariables() {
		return static::$_userData;
	}

}
