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
 * Mmi/Session/Handler/Interface.php
 * @category   Mmi
 * @package    Mmi_Session
 * @copyright  Copyright (c) 2010 HQSoft Mariusz Miłejko (http://www.hqsoft.pl)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    $Id$
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */

/**
 * Interface backendu bufora
 * @category   Mmi
 * @package    Mmi_Session
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
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
	 * @id string identyfikator sesji
	 */
	public function read($id);

	/**
	 * Zapis danych sesji 
	 * @id string identyfikator sesji
	 * @data mixed dane
	 */
	public function write($id, $data);

	/**
	 * Niszczenie sesji 
	 * @id string identyfikator sesji
	 */
	public function destroy($id);

	/**
	 * Garbage collector 
	 * @maxlifetime float maksymalny czas życia
	 */
	public function gc($maxlifetime);

}
