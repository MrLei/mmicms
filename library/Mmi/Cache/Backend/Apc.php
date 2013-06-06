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
	
	public function __construct(array $params = array()) {
		$this->_namespace = crc32(BASE_PATH);
	}

	public function load($key) {
		return apc_fetch($this->_namespace . '_' . $key);
	}

	public function save($key, $data, $lifeTime) {
        return apc_store($this->_namespace . '_' . $key, $data, $lifeTime);
	}

	public function delete($key) {
		return apc_delete($this->_namespace . '_' . $key);
	}

	public function deleteAll() {
		return apc_clear_cache('user');
	}

}
