<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Mmi\Controller\Request;

class File {
	
	/**
	 * Dane FILE
	 * @var array
	 */
	protected $_data = array();
	
	/**
	 * Konstruktor
	 * @param array $data dane z FILES
	 */
	public function __construct(array $data = array()) {
		$files = array();
		foreach ($data as $fieldName => $fieldFiles) {
			//pojedynczy upload w danym polu
			if (!is_array($fieldFiles['name'])) {
				if (!isset($fieldFiles['tmp_name']) || $fieldFiles['tmp_name'] == '') {
					continue;
				}
				$fieldFiles['type'] = \Mmi\Lib::mimeType($fieldFiles['tmp_name']);
				$files[$fieldName] = $fieldFiles;
				continue;
			}
			//upload wielokrotny html5
			for ($i = 0, $count = count($fieldFiles['name']); $i < $count; $i++) {
				if (!isset($files[$fieldName])) {
					$files[$fieldName] = array();
				}
				if (!isset($fieldFiles['tmp_name'][$i]) || !$fieldFiles['tmp_name'][$i]) {
					continue;
				}
				$files[$fieldName][$i] = array(
					'name' => $fieldFiles['name'][$i],
					'type' => \Mmi\Lib::mimeType($fieldFiles['tmp_name'][$i]),
					'tmp_name' => $fieldFiles['tmp_name'][$i],
					'error' => $fieldFiles['error'][$i],
					'size' => $fieldFiles['size'][$i]
				);
			}
		}
		$this->_data = $files;
	}
	
	/**
	 * Magiczne pobranie zmiennej żądania
	 * @param string $key klucz
	 * @return string
	 */
	public function __get($key) {
		return isset($this->_data[$key]) ? $this->_data[$key] : null;
	}

	/**
	 * Magiczne sprawczenie istnienia pola
	 * @param string $key klucz
	 * @return bool
	 */
	public function __isset($key) {
		return isset($this->_data[$key]);
	}

	/**
	 * Magicznie usuwa pole
	 * @param string $key klucz
	 */
	public function __unset($key) {
		unset($this->_data[$key]);
	}

	/**
	 * Magiczne ustawienie zmiennej żądania
	 * @param string $key klucz
	 * @param string $value wartość
	 */
	public function __set($key, $value) {
		$this->_data[$key] = $value;
	}
	
	/**
	 * Zwraca POST jako array
	 * @return array
	 */
	public function toArray() {
		return $this->_data;
	}
	
}
