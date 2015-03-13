<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Mmi\Session;

interface HandlerInterface {

	/**
	 * Otwieranie sesję
	 * @param string $savePath ścieżka sesji
	 * @param string $sessionName nazwa sesji
	 */
	public function open($savePath, $sessionName);

	/**
	 * Zamykanie sesję 
	 */
	public function close();

	/**
	 * Odczyt danych sesji
	 * @param string $id identyfikator sesji
	 */
	public function read($id);

	/**
	 * Zapis danych sesji 
	 * @param string $id identyfikator sesji
	 * @param mixed $data dane
	 */
	public function write($id, $data);

	/**
	 * Niszczenie sesji 
	 * @param string $id identyfikator sesji
	 */
	public function destroy($id);

	/**
	 * Garbage collector 
	 * @param float $maxlifetime maksymalny czas życia
	 */
	public function gc($maxlifetime);
}
