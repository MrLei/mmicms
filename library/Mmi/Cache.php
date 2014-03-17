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
 * Klasa bufora
 * @category   Mmi
 * @package    Mmi_Cache
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */
class Mmi_Cache {

	/**
	 * Konfiguracja bufora
	 * @var Mmi_Cache_Config
	 */
	protected $_config;

	/**
	 * Backend bufora
	 * @var Mmi_Cache_Backend_Interface
	 */
	protected $_backend;

	/**
	 * Przestrzeń nazw dla rejestru
	 * @var string
	 */
	protected $_registryNamespace;

	/**
	 * Konstruktor, wczytuje konfigurację i ustawia backend
	 */
	public function __construct(Mmi_Cache_Config $config) {
		$this->_config = $config;
		$saveHandler = $config->handler;
		$backendClassName = 'Mmi_Cache_Backend_' . ucfirst($saveHandler);
		$this->_backend = new $backendClassName($config);
		$this->_registryNamespace = 'Cache_' . crc32($config->path . $config->handler) . '_';
		if (!($this->_backend instanceof Mmi_Cache_Backend_Interface)) {
			throw new Exception('Cache backend invalid');
		}
	}

	/**
	 * Ładuje (jeśli istnieją) dane z bufora
	 * @param string $key klucz
	 * @return mixed
	 */
	public function load($key) {
		if (!$this->_config->active) {
			return;
		}
		if (Mmi_Registry::issetUserVariable($this->_registryNamespace . $key)) {
			return Mmi_Registry::getUserVariable($this->_registryNamespace . $key);
		}
		return Mmi_Registry::setUserVariable($this->_registryNamespace . $key, $this->_getValidCacheData($this->_backend->load($key)));
	}

	/**
	 * Zapis danych
	 * Dane zostaną zserializowane i zapisane w backendzie
	 * @param mixed $data dane
	 * @param string $key klucz
	 * @param int $lifetime czas życia
	 */
	public function save($data, $key, $lifetime = null) {
		if (!$this->_config->active) {
			return;
		}
		if ($lifetime === 0) {
			return;
		}
		if ($lifetime === null) {
			$lifetime = $this->_config->lifetime;
		}
		$expire = time() + $lifetime;
		Mmi_Registry::setUserVariable($this->_registryNamespace . $key, $data);
		return $this->_backend->save($key, $this->_setCacheData($data, $expire), $lifetime);
	}

	/**
	 * Usuwanie danych z bufora na podstawie klucza
	 * @param string $key klucz
	 */
	public function remove($key) {
		if (!$this->_config->active) {
			return;
		}
		Mmi_Registry::unsetUserVariable($key);
		return $this->_backend->delete($key);
	}

	/**
	 * Usuwa wszystkie dane z bufora
	 */
	public function flush() {
		if (!$this->_config->active) {
			return;
		}
		return $this->_backend->deleteAll();
	}

	/**
	 * Zwraca aktywność cache
	 * @return boolean
	 */
	public function isActive() {
		return $this->_config->active;
	}

	/**
	 * Serializuje dane i stempluje datą wygaśnięcia
	 * @param mixed $data dane
	 * @param int $expire wygasa
	 * @return string
	 */
	protected function _setCacheData($data, $expire) {
		return serialize(array('expire' => $expire, 'data' => $data));
	}

	/**
	 * Zwraca aktualne dane (sprawdza ważność)
	 * @param mixed $data dane
	 * @return mixed
	 */
	protected function _getValidCacheData($data) {
		if (!$data) {
			return;
		}
		$data = unserialize($data);
		if (!isset($data['expire']) || !isset($data['data'])) {
			return;
		}
		if ($data['expire'] > time()) {
			return $data['data'];
		}
	}

}
