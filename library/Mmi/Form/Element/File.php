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
 * Mmi/Form/Element/File.php
 * @category   Mmi
 * @package    Mmi_Form
 * @subpackage Element
 * @copyright  Copyright (c) 2010 HQSoft Mariusz Miłejko (http://www.hqsoft.pl)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    $Id$
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */

/**
 * Klasa elementu plik
 * @category   Mmi
 * @package    Mmi_Form
 * @subpackage Element
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */
class Mmi_Form_Element_File extends Mmi_Form_Element_Abstract {

	/**
	 * Informacje o zuploadowanym pliku
	 * @var array
	 */
	private $_fileInfo = array();

	public function fetchField() {
		if (substr($this->getName(), -2) == '[]') {
			$this->_options['multiple'] = '';
		}
		return '<input type="file" ' . $this->_getHtmlOptions() . '/>';
	}

	/**
	 * Zbiera pliki z tabeli $_FILES jeśli istnieją jakieś pliki dla tego pola
	 * @return Mmi_Form_Element_File
	 */
	public function init() {
		$fieldName = trim($this->_options['name'], '[]');
		$files = Mmi_Controller_Front::getInstance()->getRequest()->getFiles();
		if (!isset($files[$fieldName])) {
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