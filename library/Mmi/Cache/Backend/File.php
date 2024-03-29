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
 * Mmi/Cache/Backend/File.php
 * @category   Mmi
 * @package    Mmi_Cache
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    1.0.0
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

/**
 * Plikowy backend bufora
 * @category   Mmi
 * @package    Mmi_Cache
 * @license    http://milejko.com/new-bsd.txt     New BSD License
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
	public function __construct(Mmi_Cache_Config $config) {
		$this->_savePath = $config->path;
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
		if (file_put_contents($this->_savePath . '/' . $key, $data) === false) {
			return false;
		}
		return true;
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
