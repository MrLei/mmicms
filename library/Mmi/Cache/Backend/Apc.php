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
 * Mmi/Cache/Backend/Apc.php
 * @category   Mmi
 * @package    Mmi_Cache
 * @copyright  Copyright (c) 2010 HQSoft Mariusz Miłejko (http://www.hqsoft.pl)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    $Id$
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */

/**
 * Backend bufora apc
 * @category   Mmi
 * @package    Mmi_Cache
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */
class Mmi_Cache_Backend_Apc implements Mmi_Cache_Backend_Interface {

	/**
	 * Cache namespace
	 * @var string
	 */
	private $_namespace;

	/**
	 * Kostruktor
	 * @param array $params parametry
	 */
	public function __construct(Mmi_Cache_Config $config) {
		$this->_namespace = crc32(BASE_PATH);
	}

	/**
	 * Ładuje dane o podanym kluczu
	 * @param string $key klucz
	 */
	public function load($key) {
		return apc_fetch($this->_namespace . '_' . $key);
	}

	/**
	 * Zapisuje dane pod podanym kluczem
	 * @param string $key klucz
	 * @param string $data
	 * @param int $lifeTime wygaśnięcie danych w buforze (informacja dla bufora)
	 */
	public function save($key, $data, $lifeTime) {
		return apc_store($this->_namespace . '_' . $key, $data, $lifeTime);
	}

	/**
	 * Kasuje dane o podanym kluczu
	 * @param string $key klucz
	 */
	public function delete($key) {
		return apc_delete($this->_namespace . '_' . $key);
	}

	/**
	 * Kasuje wszystkie dane
	 */
	public function deleteAll() {
		return apc_clear_cache('user');
	}

}
