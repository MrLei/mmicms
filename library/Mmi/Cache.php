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
 * Mmi/Cache.php
 * @category   Mmi
 * @package    Mmi_Cache
 * @copyright  Copyright (c) 2010 HQSoft Mariusz Miłejko (http://www.hqsoft.pl)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    $Id$
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */

/**
 * Prosta klasa buforowania (cache) z domyślnych wartości config
 * Automatycznie sprawdza aktywności bufora
 * @category   Mmi
 * @package    Mmi_Cache
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */
class Mmi_Cache {

	/**
	 * Slave
	 * @var Mmi_Cache_Slave
	 */
	protected static $_slave;

	/**
	 * Określa aktywność cache
	 * @var boolean
	 */
	protected static $_active = false;

	/**
	 * Pobiera instancję
	 * @return Mmi_Cache
	 */
	protected static function _init() {
		if (null === static::$_slave) {
			static::$_active = (isset(Mmi_Config::$data['cache']['active']) && Mmi_Config::$data['cache']['active']) ? true : false;
			static::$_slave = new Mmi_Cache_Slave(Mmi_Config::$data['cache']);
		}
	}

	/**
	 * Ładuje (jeśli istnieją) dane z bufora
	 * @param string $key klucz
	 * @return mixed
	 */
	public static function load($key) {
		if (!static::$_active) {
			return;
		}
		static::_init();
		return static::$_slave->load($key);
	}

	/**
	 * Zapis danych
	 * Dane zostaną zserializowane i zapisane w backendzie
	 * @param mixed $data dane
	 * @param string $key klucz
	 * @param int $lifeTime czas życia
	 */
	public static function save($data, $key, $lifeTime = null) {
		if (!static::$_active) {
			return;
		}
		static::_init();
		return static::$_slave->save($data, $key, $lifeTime);
	}

	/**
	 * Usuwanie danych z bufora na podstawie klucza
	 * @param string $key klucz
	 */
	public static function remove($key) {
		if (!static::$_active) {
			return;
		}
		static::_init();
		return static::$_slave->remove($key);
	}

	/**
	 * Usuwa wszystkie dane z bufora
	 */
	public static function flush() {
		if (!static::$_active) {
			return;
		}
		static::_init();
		return static::$_slave->flush();
	}

}
