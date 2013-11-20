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
 * Mmi/Cache/Backend/Interface.php
 * @category   Mmi
 * @package    Mmi_Cache
 * @copyright  Copyright (c) 2010 HQSoft Mariusz Miłejko (http://www.hqsoft.pl)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    $Id$
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */

/**
 * Interface backendu bufora
 * @category   Mmi
 * @package    Mmi_Cache
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */
interface Mmi_Cache_Backend_Interface {

	/**
	 * Konstruktor
	 * @param array $params opcje
	 */
	public function __construct(Mmi_Cache_Config $config);

	/**
	 * Ładuje dane o podanym kluczu
	 * @param string $key klucz
	 */
	public function load($key);

	/**
	 * Zapisuje dane pod podanym kluczem
	 * @param string $key klucz
	 * @param string $data
	 * @param int $lifeTime wygaśnięcie danych w buforze (informacja dla bufora)
	 */
	public function save($key, $data, $lifeTime);

	/**
	 * Kasuje dane o podanym kluczu
	 * @param string $key klucz
	 */
	public function delete($key);

	/**
	 * Kasuje wszystkie dane
	 */
	public function deleteAll();

}
