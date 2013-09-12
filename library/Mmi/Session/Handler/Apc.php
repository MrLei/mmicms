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
	
	/**
	 * Nazwa sesji
	 * @var string
	 */
	protected $_sessionName;
	
	/**
	 * Otwieranie sesję
	 * @param string $savePath ścieżka sesji
	 * @param string $sessionName nazwa sesji
	 */
	public function open($savePath, $sessionName) {
		$this->_sessionName = $sessionName;
		return true;
	}
	
	/**
	 * Zamykanie sesję 
	 * @return boolean
	 */
	public function close() {
		return true;
	}

	/**
	 * Odczyt danych sesji
	 * @param string $id identyfikator sesji
	 * @return mixed
	 */
	public function read($id) {
		return apc_fetch($this->_sessionName . '-' . $id);
	}

	/**
	 * Zapis danych sesji 
	 * @param string $id identyfikator sesji
	 * @param mixed $data dane
	 * @return boolean
	 */
	public function write($id, $data) {
		return apc_store($this->_sessionName . '-' . $id, $data, session_cache_expire());
	}

	/**
	 * Niszczenie sesji 
	 * @param string $id identyfikator sesji
	 * @return mixed
	 */
	public function destroy($id) {
		return apc_delete($this->_sessionName . '-' . $id);
	}

	/**
	 * Garbage collector 
	 * @param float $maxlifetime maksymalny czas życia
	 * @return boolean
	 */
	public function gc($maxlifetime) {
		return true;
	}

}
