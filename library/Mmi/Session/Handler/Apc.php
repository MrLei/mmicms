<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Mmi\Session\Handler;

class Apc implements HandlerInterface {

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
