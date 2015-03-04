<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Mmi\Controller\Request;

class File extends \Mmi\DataObject {
	
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
	 * Zwraca POST jako array
	 * @return array
	 */
	public function toArray() {
		return $this->_data;
	}
	
}
