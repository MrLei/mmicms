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
	private $_files = array();

	/**
	 * Buduje pole
	 * @return string
	 */
	public function fetchField() {
		return '<input type="file" ' . $this->_getHtmlOptions() . '/>';
	}

	/**
	 * Zbiera pliki z tabeli $_FILES jeśli istnieją jakieś pliki dla tego pola
	 * @return \Mmi\Form\Element\File
	 */
	public function init() {
		$fieldName = $this->_options['name'];
		//tablica obiektów file
		$files = \Mmi\Controller\Front::getInstance()->getRequest()->getFiles();
		//brak pliku dla tego elementu formularza
		if (!$files->{$fieldName}) {
			return;
		}
		$this->_files = $files->{$fieldName};
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
