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
 * Mmi/Cache/Backend/Memcache.php
 * @category   Mmi
 * @package    Mmi_Cache
 * @copyright  Copyright (c) 2010 HQSoft Mariusz Miłejko (http://www.hqsoft.pl)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    $Id$
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */

/**
 * Backend bufora memcache
 * @category   Mmi
 * @package    Mmi_Cache
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */
class Mmi_Cache_Backend_Memcache implements Mmi_Cache_Backend_Interface {

	/**
	 * Przechowuje obiekt Memcache
	 * @var Memcache
	 */
	private $_server;

	/**
	 * Cache namespace
	 * @var string
	 */
	private $_namespace;

	/**
	 * Ustawia obiekt Memcache
	 * @param array $params parametry
	 */
	public function __construct(Mmi_Cache_Config $config) {
		//@TODO: przenieść namespace do konfiguracji
		$this->_namespace = crc32(BASE_PATH);
		$this->_server = new Memcache();
		if (is_array($config->path)) {
			$this->_addServers($config->path);
		} else {
			$this->_addServer($config->path);
		}
	}

	/**
	 * Ładuje dane o podanym kluczu
	 * @param string $key klucz
	 */
	public final function load($key) {
		return $this->_server->get($this->_namespace . '_' . $key);
	}

	/**
	 * Zapisuje dane pod podanym kluczem
	 * @param string $key klucz
	 * @param string $data
	 * @param int $lifeTime wygaśnięcie danych w buforze (informacja dla bufora)
	 */
	public final function save($key, $data, $lifeTime) {
		if ($lifeTime > 2592000) {
			//memcache bug ta wartość nie może być większa
			$lifeTime = 2592000;
		}
		return $this->_server->set($this->_namespace . '_' . $key, $data, 0, $lifeTime);
	}

	/**
	 * Kasuje dane o podanym kluczu
	 * @param string $key klucz
	 */
	public final function delete($key) {
		return $this->_server->delete($this->_namespace . '_' . $key);
	}

	/**
	 * Kasuje wszystkie dane
	 */
	public final function deleteAll() {
		return $this->_server->flush();
	}

	/**
	 * Parsuje adres serwera memcached
	 * @param string $link źródło
	 * @return array
	 */
	protected final function _parseMemcacheAddress($link) {
		$protoSeparator = strpos($link, '://');
		if ($protoSeparator !== false) {
			$link = substr($link, $protoSeparator + 3);
		}
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
		$server = $this->_parseMemcacheAddress($server);
		$this->_server->addServer(
			$server['host'],
			$server['port'],
			isset($server['persistent']) ? $server['persistent'] : true,
			isset($server['weight']) ? $server['weight'] : 1,
			isset($server['timeout']) ? $server['timeout'] : 15,
			isset($server['retry_interval']) ? $server['retry_interval'] : 15
		);
	}

	/**
	 * Dodaje serwery
	 * @param array $servers tablica adresów serwera
	 */
	protected final function _addServers(array $servers) {
		foreach ($servers as $server) {
			$this->_addServer($server);
		}
	}

}
