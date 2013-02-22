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
class Mmi_Registry {

	/**
	 * Rejestr
	 * @var array
	 */
	private static $_data;

	/**
	 * Ustawia zmienną w rejestrze
	 * @param string $key klucz
	 * @param mixed $value obiekt
	 */
	public static function set($key, $value) {
		return self::$_data[$key] = $value;
	}

	/**
	 * Pobiera zmienną z rejestru
	 * @param string $key klucz
	 * @return mixed
	 */
	public static function get($key) {
		return isset(self::$_data[$key]) ? self::$_data[$key] : null;
	}

	/**
	 * Pobiera wszystkie klucze w rejestrze
	 * @return array
	 */
	public static function getKeys() {
		$keys = array();
		foreach (self::$_data as $key => $value) {
			$keys[$key] = $value;
		}
		return $keys;
	}
}
