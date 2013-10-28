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
 * Mmi/Cache/Slave.php
 * @category   Mmi
 * @package    Mmi_Cache
 * @copyright  Copyright (c) 2010 HQSoft Mariusz Miłejko (http://www.hqsoft.pl)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    $Id$
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */

/**
 * Klasa pojedynczego bufora
 * @category   Mmi
 * @package    Mmi_Cache
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */
class Mmi_Cache_Slave {

	/**
	 * Backend bufora
	 * @var Mmi_Cache_Backend_Interface
	 */
	protected $_backend;

	/**
	 * Czas życia danych w buforze
	 * @var int
	 */
	protected $_lifeTime;

	/**
	 * Konstruktor, wczytuje konfigurację i ustawia backend
	 */
	public function __construct(array $params = array()) {
		$this->_lifeTime = isset($params['lifetime']) ? $params['lifetime'] : 300;
		$saveHandler = isset($params['save_handler']) ? $params['save_handler'] : 'apc';
		$backendClassName = 'Mmi_Cache_Backend_' . ucfirst($saveHandler);
		$this->_backend = new $backendClassName($params);
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
		return $this->_getValidCacheData($this->_backend->load($key));
	}

	/**
	 * Zapis danych
	 * Dane zostaną zserializowane i zapisane w backendzie
	 * @param mixed $data dane
	 * @param string $key klucz
	 * @param int $lifeTime czas życia
	 */
	public function save($data, $key, $lifeTime = null) {
		if ($lifeTime === 0) {
			return;
		}
		if ($lifeTime === null) {
			$lifeTime = $this->_lifeTime;
		}
		$expire = time() + $lifeTime;
		$this->_backend->save($key, $this->_setCacheData($data, $expire), $lifeTime);
	}

	/**
	 * Usuwanie danych z bufora na podstawie klucza
	 * @param string $key klucz
	 */
	public function remove($key) {
		return $this->_backend->delete($key);
	}

	/**
	 * Usuwa wszystkie dane z bufora
	 */
	public function flush() {
		return $this->_backend->deleteAll();
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
