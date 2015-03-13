<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Cms;

abstract class Form extends \Mmi\Form {

	/**
	 * Nazwa obiektu do przypięcia plików
	 * @var string
	 */
	protected $_fileObjectName;

	/**
	 * Konstruktor
	 * @param \Mmi\Dao\Record\Ro $record obiekt recordu
	 * @param array $options opcje
	 * @param string $className nazwa klasy
	 */
	public function __construct(\Mmi\Dao\Record\Ro $record = null, array $options = array(), $className = null) {
		//kalkulacja nazwy plików dla active record
		if ($record) {
			$this->_fileObjectName = $this->_classToFileObject(get_class($record));
		}
		parent::__construct($record, $options, $className);
	}

	/**
	 * Wywołuje walidację i zapis rekordu powiązanego z formularzem.
	 * @return bool
	 */
	public function save() {
		if ($this->hasRecord() && parent::save()) {
			$this->_appendFiles($this->_record->getPk(), $this->getFiles());
		}
		return $this->isSaved();
	}

	/**
	 * Zabezpieczenie spamowe
	 * @param string $name nazwa
	 * @return \Mmi\Form\Element\Antirobot
	 */
	public function addElementAntirobot($name) {
		return $this->addElement(new \Cms\Form\Element\Antirobot($name));
	}

	/**
	 * Captcha
	 * @param string $name nazwa
	 * @return \Mmi\Form\Element\Captcha
	 */
	public function addElementCaptcha($name) {
		return $this->addElement(new \Cms\Form\Element\Captcha($name));
	}

	/**
	 * Wybór koloru
	 * @param string $name nazwa
	 * @return \Mmi\Form\Element\ColorPicker
	 */
	public function addElementColorPicker($name) {
		return $this->addElement(new \Cms\Form\Element\ColorPicker($name));
	}

	/**
	 * Date picker
	 * @param string $name nazwa
	 * @return \Mmi\Form\Element\DatePicker
	 */
	public function addElementDatePicker($name) {
		return $this->addElement(new \Cms\Form\Element\DatePicker($name));
	}

	/**
	 * Date-time picker
	 * @param string $name nazwa
	 * @return \Mmi\Form\Element\DateTimePicker
	 */
	public function addElementDateTimePicker($name) {
		return $this->addElement(new \Cms\Form\Element\DateTimePicker($name));
	}

	/**
	 * TinyMce
	 * @param string $name nazwa
	 * @return \Mmi\Form\Element\TinyMce
	 */
	public function addElementTinyMce($name) {
		return $this->addElement(new \Cms\Form\Element\TinyMce($name));
	}

	/**
	 * Uploader
	 * @param string $name nazwa
	 * @return \Mmi\Form\Element\Uploader
	 */
	public function addElementUploader($name) {
		return $this->addElement(new \Cms\Form\Element\Uploader($name));
	}

	/**
	 * Zwraca nazwę obiektu do przypięcia plików
	 * @return string
	 */
	public function getFileObjectName() {
		return $this->_fileObjectName;
	}

	/**
	 * Ustawia nazwę obiektu do przypięcia plików
	 * @param string $name nazwa
	 */
	public function setFileObjectName($name) {
		$this->_fileObjectName = $name;
	}

	/**
	 * Dołaczenie plików do obiektu
	 * @param mixed $id
	 * @param array $files tabela plików
	 */
	protected function _appendFiles($id, $files) {
		try {
			foreach ($files as $fileSet) {
				\Cms\Model\File\Dao::appendFiles($this->_fileObjectName, $id, $fileSet);
			}
			//przenoszenie z uploadera
			\Cms\Model\File\Dao::move('tmp-' . $this->_fileObjectName, \Mmi\Session::getNumericId(), $this->_fileObjectName, $id);
		} catch (\Exception $e) {
			\Mmi\Exception\Logger::log($e);
		}
	}

	/**
	 * Import plików z pól formularza i sesji
	 * Zwraca tabelę danych plików
	 * @return array
	 */
	public function getFiles() {
		$files = array();
		//import z elementów File
		foreach ($this->getElements() as $element) {
			if ($element->getType() != '\Mmi\Form\Element\File') {
				continue;
			}
			if (!$element->isUploaded()) {
				continue;
			}
			$files[$element->getName()] = $element->getFileInfo();
		}
		return $files;
	}

	/**
	 * Zwraca nazwę plików powiązanych z danym formularzem (na podstawie klasy rekordu / modelu)
	 * @param string $name
	 * @return string
	 */
	protected function _classToFileObject($name) {
		$name = explode('\\', $name);
		$fileObject = '';
		foreach ($name as $part) {
			$part = strtolower($part);
			if (isset($first) && $part == $first || $part == 'model' || $part == 'record') {
				continue;
			}
			$first = $part;
			$fileObject .= $part;
		}
		return $fileObject;
	}

}
