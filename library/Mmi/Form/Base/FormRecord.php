<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Mmi\Form\Base;

abstract class FormRecord extends FormCore {

	/**
	 * Obiekt rekordu
	 * @var \Mmi\Dao\Record
	 */
	protected $_record;

	/**
	 * Identyfikator rekordu
	 * @var mixed
	 */
	protected $_recordId;

	/**
	 * Metoda zapisu w rekordzie
	 * @var string
	 */
	protected $_recordSaveMethod = 'save';

	/**
	 * Czy zapisany
	 * @var boolean
	 */
	protected $_saved = false;

	/**
	 * Zwrot zapisu z modelu
	 * @var mixed
	 */
	protected $_saveResult;

	/**
	 * Namespace powiązany z tym formularzem
	 * @var \Mmi\Session\Space
	 */
	protected $_sessionNamespace = null;

	/**
	 * Bramka zapisu danych
	 * @param array $data
	 * @return array
	 */
	public function prepareSaveData(array $data = array()) {
		return $data;
	}

	/**
	 * Bramka odczytu danych
	 * @param array $data
	 * @return array
	 */
	public function prepareLoadData(array $data = array()) {
		return $data;
	}

	/**
	 * Czy w modelu wystąpił zapis
	 * @return boolean
	 */
	public function isSaved() {
		return $this->_saved;
	}

	/**
	 * Zwraca status z zapisu rekordu.
	 * @return mixed
	 */
	public function getSaveResult() {
		return $this->_saveResult;
	}

	/**
	 * Zwraca obiekt aktywnego rekordu
	 * @return \Mmi\Dao\Record
	 */
	public function getRecord() {
		return $this->_record;
	}

	/**
	 * Czy do formularza przypisany jest active record, jeśli nie, a podana jest nazwa, stworzy obiekt rekordu
	 * @return boolean
	 */
	public function hasRecord() {
		return (null !== $this->_record);
	}
	
	/**
	 * Sprawdza czy rekord zawiera dane
	 * @return boolean
	 */
	public function hasNotEmptyRecord() {
		if (!$this->hasRecord()) {
			return false;
		}
		foreach ($this->_record->toArray() as $k => $v) {
			if ($v !== null) {
				return true;
			}
		}
		return false;
	}

	/**
	 * Wywołuje walidację i zapis rekordu powiązanego z formularzem.
	 * @return bool
	 */
	public function save() {
		if (!$this->hasRecord()) {
			return $this->_saved = false;
		}
		if (!$this->isValid()) {
			return $this->_saved = false;
		}
		$this->_saved = $this->_saveRecord();
		$this->_saveResult = $this->_record->getSaveStatus();
		if ($this->_saved === false) {
			return false;
		}
		if (null != $this->_sessionNamespace) {
			$this->_sessionNamespace->unsetAll();
		}
		$this->_recordId = $this->_record->getPk();
		return true;
	}

	/**
	 * Zapis danych do obiektu rekordu
	 * @return boolean
	 */
	protected function _saveRecord() {
		if (!method_exists(($this->_record), $this->_recordSaveMethod)) {
			throw new \Exception('Save method unsupported: ' . $this->_recordSaveMethod);
		}
		$data = array();
		//pobieranie danych z elementów
		foreach ($this->getElements() as $element) {
			//ignorowanie CTRL
			if ($element->getName() == $this->_formBaseName . '__ctrl') {
				continue;
			}
			//dodawanie wartości do tabeli
			$data[$element->getName()] = $element->getValue();
		}
		//ustawianie rekordu na podstawie danych
		$this->_record->setFromArray($this->prepareSaveData($data));
		return $this->_record->{$this->_recordSaveMethod}();
	}

}
