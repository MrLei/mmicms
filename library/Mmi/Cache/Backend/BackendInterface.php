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
 * Mmi/Cache/Backend/Interface.php
 * @category   Mmi
 * @package    \Mmi\Cache
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    1.0.0
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */
/**
 * Interface backendu bufora
 * @category   Mmi
 * @package    \Mmi\Cache
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

namespace Mmi\Cache\Backend;

interface BackendInterface {

	/**
	 * Konstruktor
	 * @param array $params opcje
	 */
	public function __construct(\Mmi\Cache\Config $config);

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
