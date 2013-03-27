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
 * Mmi/Session/Handler/Apc.php
 * @category   Mmi
 * @package    Mmi_Session
 * @copyright  Copyright (c) 2010 HQSoft Mariusz Miłejko (http://www.hqsoft.pl)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    $Id$
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */

/**
 * Handler sesji w APC
 * @category   Mmi
 * @package    Mmi_Session
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */
class Mmi_Session_Handler_Apc implements Mmi_Session_Handler_Interface {
	
	protected $_sessionName;
	
	public function open($savePath, $sessionName) {
		$this->_sessionName = $sessionName;
		return true;
	}
	
	public function close() {
		return true;
	}

	public function read($id) {
		return apc_fetch($this->_sessionName . '-' . $id);
	}

	public function write($id, $data) {
		return apc_store($this->_sessionName . '-' . $id, $data, session_cache_expire());
	}

	public function destroy($id) {
		return apc_delete($this->_sessionName . '-' . $id);
	}

	public function gc($maxlifetime) {
		return true;
	}
	
}
