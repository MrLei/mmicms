<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Mmi\Controller\Request;

/**
 * Klasa plików
 * @method File[] toArray() Zwraca tablicę obiektów plików \Mmi\Controller\Request\File
 */
class Files extends \Mmi\DataObject {

	/**
	 * Konstruktor
	 * @param array $data dane z FILES
	 */
	public function __construct(array $data = array()) {
		//obsługa uploadu plików
		$this->setParams($this->_handleUpload($data));
	}

	/**
	 * Zwraca tablicę obiektów plików
	 * @param array $data
	 * @return array
	 */
	protected function _handleUpload(array $data) {
		$files = array();
		foreach ($data as $fieldName => $fieldFiles) {
			if (!isset($files[$fieldName])) {
				$files[$fieldName] = array();
			}
			//pojedynczy plik
			if (null !== ($file = $this->_handleSingleUpload($fieldFiles))) {
				$files[$fieldName][] = $file;
				continue;
			}
			//obsługa multiuploadu HTML5
			$files[$fieldName] = $this->_handleMultiUpload($fieldFiles);
		}
		return $files;
	}

	protected function _handleSingleUpload($fileData) {
		//jeśli nazwa jest tablicą, oznacza to wielokrotny upload HTML5
		if (is_array($fileData['name'])) {
			return;
		}
		//brak 
		if (!isset($fileData['tmp_name']) || $fileData['tmp_name'] == '') {
			return;
		}
		$fieldFiles['type'] = \Mmi\Lib::mimeType($fieldFiles['tmp_name']);
		return new File($fieldFiles);
	}

	protected function _handleMultiUpload($fileData) {
		$files = array();
		//upload wielokrotny html5
		for ($i = 0, $count = count($fileData); $i < $count; $i++) {
			if (!isset($fileData['tmp_name'][$i]) || !$fileData['tmp_name'][$i]) {
				continue;
			}
			//przekazywanie plików
			$files[] = new File(array(
				'name' => $fileData['name'][$i],
				'tmp_name' => $fileData['tmp_name'][$i],
				'size' => $fileData['size'][$i]
			));
		}
		return $files;
	}

}
