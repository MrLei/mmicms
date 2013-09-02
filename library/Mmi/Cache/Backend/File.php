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
 * Mmi/Cache/Backend/File.php
 * @category   Mmi
 * @package    Mmi_Cache
 * @copyright  Copyright (c) 2010 HQSoft Mariusz Miłejko (http://www.hqsoft.pl)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    $Id$
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */

/**
 * Plikowy backend bufora
 * @category   Mmi
 * @package    Mmi_Cache
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */
class Mmi_Cache_Backend_File implements Mmi_Cache_Backend_Interface {

	/**
	 * Przechowuje ścieżkę zapisu
	 * @var string
	 */
	protected $_savePath;
	/**
	 * Kostruktor
	 * @param array $params parametry
	 */
	public function __construct(array $params = array()) {
		$this->_savePath = $params['save_path'];
	}

	/**
	 * Ładuje dane o podanym kluczu
	 * @param string $key klucz
	 */
	public function load($key) {
		if (file_exists($this->_savePath . '/' . $key)) {
			return file_get_contents($this->_savePath . '/' . $key);
		}
	}

	/**
	 * Zapisuje dane pod podanym kluczem
	 * @param string $key klucz
	 * @param string $data
	 * @param int $lifeTime wygaśnięcie danych w buforze (informacja dla bufora)
	 */
	public function save($key, $data, $lifeTime) {
		file_put_contents($this->_savePath . '/' . $key, $data);
	}

	/**
	 * Kasuje dane o podanym kluczu
	 * @param string $key klucz
	 */
	public function delete($key) {
		if (file_exists($this->_savePath . '/' . $key)) {
			unlink($this->_savePath . '/' . $key);
		}
	}

	/**
	 * Kasuje wszystkie dane
	 */
	public function deleteAll() {
		foreach (glob($this->_savePath . '/*') as $fileName) {
			unlink($fileName);
		}
	}

}
