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
 * Mmi/Cache/Backend/Memcached.php
 * @category   Mmi
 * @package    Mmi_Cache
 * @copyright  Copyright (c) 2010 HQSoft Mariusz Miłejko (http://www.hqsoft.pl)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    $Id$
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */

/**
 * Backend bufora memcached
 * @category   Mmi
 * @package    Mmi_Cache
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */
class Mmi_Cache_Backend_Memcached implements Mmi_Cache_Backend_Interface {

	/**
	 * Przechowuje obiekt Memcached
	 * @var Memcached
	 */
	private $_server;
	
	/**
	 * Cache namespace
	 * @var string
	 */
	private $_namespace;

	/**
	 * Ustawia obiekt Memcached
	 * @param array $params parametry
	 */
	public function __construct(array $params = array()) {
		$this->_namespace = crc32(BASE_PATH);
		$this->_server = new Memcached();
		if (is_array($params['save_path'])) {
			$this->_addServers($params['save_path']);
		} else {
			$this->_addServer($params['save_path']);
		}
		$this->_server->setOption(Memcached::OPT_BINARY_PROTOCOL, true);
		if (Memcached::HAVE_IGBINARY) {
			$this->_server->setOption(Memcached::OPT_SERIALIZER, Memcached::SERIALIZER_IGBINARY);
		}
	}

	/**
	 * Ładuje dane o podanym kluczu
	 * @param string $key klucz
	 */
	public function load($key) {
		return $this->_server->get($this->_namespace . '_' . $key);
	}

	/**
	 * Zapisuje dane pod podanym kluczem
	 * @param string $key klucz
	 * @param string $data
	 * @param int $lifeTime wygaśnięcie danych w buforze (informacja dla bufora)
	 */
	public function save($key, $data, $lifeTime) {
		return $this->_server->set($this->_namespace . '_' . $key, $data, $lifeTime);
	}

	/**
	 * Kasuje dane o podanym kluczu
	 * @param string $key klucz
	 */
	public function delete($key) {
		return $this->_server->delete($this->_namespace . '_' . $key);
	}

	/**
	 * Kasuje wszystkie dane
	 */
	public function deleteAll() {
		return $this->_server->flush();
	}

	/**
	 * Parsuje adres serwera memcached
	 * @param string $link źródło
	 * @return array
	 */
	protected final function _parseMemcachedAddress($link) {
		$server = $link;
		$serverOptions = array();
		$hookSeparator = strpos($link, '?');
		if ($hookSeparator !== false) {
			$server = substr($link, 0, $hookSeparator);
			parse_str(substr($link, $hookSeparator + 1), $serverOptions);
		}
		$server = explode(':', $server);
		$serverOptions['host'] = $server[0];
		$serverOptions['port'] = $server[1];
		return $serverOptions;
	}
	

	/**
	 * Dodaje serwer
	 * @param string $server adres serwera
	 */
	protected function _addServer($server) {
		$server = $this->_parseMemcachedAddress($server);
		$this->_server->addServer(
			$server['host'],
			$server['port'],
			isset($server['weight']) ? $server['weight'] : 1
		);
	}
	
	/**
	 * Dodaje serwery
	 * @param array $servers tablica adresów serwera
	 */
	protected function _addServers(array $servers) {
		foreach ($servers as $server) {
			$this->_addServer($server);
		}
	}
	
	/**
	 * Magiczne wywołanie metod z Memcached
	 * @param string $method nazwa metody
	 * @param array $params tablica z parametrami
	 * @return mixed
	 */
	public function __call($method, $params) {
		return call_user_func_array(array($this->_server, $method), $params);
	}

}
