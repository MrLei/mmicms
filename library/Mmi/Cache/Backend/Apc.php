<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Mmi\Cache\Backend;

class Apc implements BackendInterface {

	/**
	 * Cache namespace
	 * @var string
	 */
	private $_namespace;

	/**
	 * Kostruktor
	 * @param array $params parametry
	 */
	public function __construct(\Mmi\Cache\Config $config) {
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
