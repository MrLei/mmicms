<?php

/**
 * Mmi
 *
 * LICENSE
 *
 * Ten plik źródłowy objęty jest licencją BSD bez klauzuli ogłoszeniowej.
 * Licencja jest dostępna pod adresem: http://milejko.com/new-bsd.txt
 * W przypadku problemów, prosimy o kontakt na adres mariusz@milejko.pl
 *
 * Mmi/Session/Handler/Interface.php
 * @category   Mmi
 * @package    Mmi_Session
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    1.0.0
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

/**
 * Interface backendu bufora
 * @category   Mmi
 * @package    Mmi_Session
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */
interface Mmi_Session_Handler_Interface {

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
	 *@param float $maxlifetime maksymalny czas życia
	 */
	public function gc($maxlifetime);

}
