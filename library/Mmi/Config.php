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
 * Mmi/Config.php
 * @category   Mmi
 * @package    Mmi_Config
 * @copyright  Copyright (c) 2010 HQSoft Mariusz Miłejko (http://www.hqsoft.pl)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    $Id$
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */

/**
 * Klasa implementuje konfigurator aplikacji
 * @category   Mmi
 * @package    Mmi_Config
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */
class Mmi_Config {

	/**
	 * Zmienne konfiguracyjne
	 * @var array
	 */
	public static $data = array();

	/**
	 * Łączy istniejące opcje z nowymi (nadpisuje istniejące)
	 * @param array $data opcje
	 */
	public static function addConfig(array $options = array()) {
		self::$data = array_merge(self::$data, $options);
	}
	
	/**
	 * Ustawia opcje na podane (czyści wszystkie stare opcje)
	 * @param array $options
	 */
	public static function setConfig(array $options = array()) {
		self::$data = $options;
	}

	/**
	 * Funkcja pobierania zmiennej konfiguracyjnej w dowolnym zagnieżdżeniu
	 * kolejne zagnieżdżenie to kolejny parametr
	 * przykład: Mmi_Config::get('global', 'cache', 'active')
	 * @return mixed
	 */
	public static function get() {
		$args = func_get_args();
		$data = self::$data;
		foreach ($args as $arg) {
			if (!isset($data[$arg])) {
				return null;
			}
			$data = $data[$arg];
		}
		return $data;
	}

	/**
	 * Funkcja ustawia wartość zmiennej konfiguracyjnej w dowolnym zagnieżdżeniu
	 * kolejne zagnieżdżenie to kolejny parametr, wartość to ostatni parametr
	 * przykład: Mmi_Config::set('global', 'cache', 'active', false)
	 */
	public static function set() {
		$args = func_get_args();
		if (!is_array($args) || count($args) < 2) {
			return;
		}
		$value = $args[count($args) - 1];
		array_pop($args);
		$data = &self::$data;
		foreach ($args as $arg) {
			$data = &$data[$arg];
		}
	}

}
