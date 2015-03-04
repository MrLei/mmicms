<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Mmi\Form;

abstract class RecordOperation extends \Mmi\OptionObject {

	/**
	 * Nazwa formularza
	 * @var string
	 */
	protected $_formBaseName;

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
	 * Wywołuje walidację i zapis rekordu powiązanego z formularzem.
	 * @return bool
	 */
	public function save() {
		if (!$this->hasRecord()) {
			return $this->isSaved();
		}
		if (!$this->isProper()) {
			return $this->isSaved();
		}
		$this->_saved = $this->_saveRecord($this->_values);
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
	 * @param array $data
	 * @return boolean
	 */
	protected function _saveRecord($data) {
		unset($data[$this->_formBaseName . '__ctrl']);
		$this->_record->setFromArray($data);
		if (method_exists(($this->_record), $this->_recordSaveMethod)) {
			return $this->_record->{$this->_recordSaveMethod}();
		}
		throw new\Exception('Save method unsupported: ' . $this->_recordSaveMethod);
	}

}
