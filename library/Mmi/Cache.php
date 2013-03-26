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
 * Klasa buforowania (cache)
 * @category   Mmi
 * @package    Mmi_Cache
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */
class Mmi_Cache {

	/**
	 * Instancja
	 * @var Mmi_Cache
	 */
	private static $_instance;

	/**
	 * Backend bufora (źródło danych)
	 * @var mixed
	 */
	private $_backend;

	/**
	 * Czas życia danych w buforze
	 * @var int
	 */
	private $_lifeTime;

	/**
	 * Pobiera instancję
	 * @return Mmi_Cache
	 */
	public static function getInstance() {
		if (null === self::$_instance) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * Konstruktor, wczytuje konfigurację i ustawia backend
	 */
	protected function __construct() {
		$this->_lifeTime = Mmi_Config::$data['cache']['lifetime'];
		$backend = 'Mmi_Cache_Backend_' . ucfirst(Mmi_Config::$data['cache']['save_handler']);
		$this->_backend = new $backend(Mmi_Config::$data['cache']);
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
		if ($lifeTime === null) {
			$lifeTime = $this->_lifeTime;
		} elseif ($lifeTime == 0) {
			return;
		}
		$expire = time() + $lifeTime;
		$this->_backend->save($key, $this->_setCacheData($data, $expire), $lifeTime);
	}

	/**
	 * Usuwanie danych z bufora na podstawie klucza
	 * @param string $key klucz
	 */
	public function remove($key) {
		$this->_backend->delete($key);
	}

	/**
	 * Usuwa wszystkie dane z bufora
	 */
	public function flush() {
		$this->_backend->deleteAll();
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
