<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Mmi\Form\Element;

class File extends ElementAbstract {

	/**
	 * Informacje o zuploadowanym pliku
	 * @var array
	 */
	private $_fileInfo = array();

	/**
	 * Buduje pole
	 * @return string
	 */
	public function fetchField() {
		if (substr($this->getName(), -2) == '[]') {
			$this->_options['multiple'] = 'multiple';
			if (isset($this->_options['count']) && $this->_options['count'] > 1) {
				$html = '';
				for ($i = 0; $i < $this->_options['count']; $i++) {
					$html .= '<input type="file" ' . $this->_getHtmlOptions() . '/><br />';
				}
				return $html;
			}
		}
		return '<input type="file" ' . $this->_getHtmlOptions() . '/>';
	}

	/**
	 * Ustawia, że pole wielokrotne
	 * @param int $count ile plików
	 * @return \Mmi\Form\Element\File
	 */
	public function setMultiple($count = 2) {
		if (substr($this->getName(), -2) == '[]') {
			$this->_options['multiple'] = 'multiple';
			$this->_options['count'] = intval($count);
		}
		return $this;
	}

	/**
	 * Zbiera pliki z tabeli $_FILES jeśli istnieją jakieś pliki dla tego pola
	 * @return \Mmi\Form\Element\File
	 */
	public function init() {
		$fieldName = trim($this->_options['name'], '[]');
		$files = \Mmi\Controller\Front::getInstance()->getRequest()->getFiles();
		if (!isset($files[$fieldName]) || empty($files[$fieldName])) {
			return;
		}
		//pojedynczy upload
		if (!array_key_exists(0, $files[$fieldName])) {
			$files[$fieldName] = array($files[$fieldName]);
		}
		$this->_fileInfo = $files[$fieldName];
		foreach ($this->_fileInfo as $key => $file) {
			//TODO: add validators here
			if ($file['type'] == 'image/x-ms-bmp') {
				unset($this->_fileInfo[$key]);
			}
		}
		return $this;
	}

	/**
	 * Pobiera informacje o wgranym pliku (jeśli istnieje)
	 * @return array
	 */
	public function getFileInfo() {
		return $this->_fileInfo;
	}

	/**
	 * Zwraca czy plik został zuploadowany do tego pola
	 * @return boolean
	 */
	public function isUploaded() {
		return ($this->_fileInfo !== null);
	}

}
