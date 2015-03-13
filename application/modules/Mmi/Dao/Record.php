<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Mmi\Dao;

class Record extends \Mmi\Dao\Record\Ro {

	/**
	 * Status zapisu
	 * 0 - bez zmian
	 * 1 - poprawnie zapisano
	 * pozostałe mogą być używane przez programistów
	 * @var int
	 */
	protected $_saveStatus = 0;

	/**
	 * Zapis danych do obiektu
	 * @return bool
	 */
	public function save() {
		if ($this->getPk() !== null) {
			return $this->_update();
		}
		return $this->_insert();
	}

	/**
	 * Zwraca status ostatniego zapisu
	 * @return int status
	 */
	public function getSaveStatus() {
		return $this->_saveStatus;
	}

	/**
	 * Kasowanie obiektu
	 * @return boolean
	 */
	public function delete() {
		if ($this->getPk() === null) {
			return false;
		}
		$dao = $this->_daoClass;
		$bindKey = \Mmi\Db\Adapter\Pdo\PdoAbstract::generateRandomBindKey();
		$result = $dao::getAdapter()->delete($dao::getTableName(), $this->_pkWhere($bindKey), array($bindKey => $this->getPk()));
		return ($result > 0) ? true : false;
	}

	/**
	 * Wstawienie danych (przez save)
	 * @return bool
	 */
	protected function _insert() {
		$dao = $this->_daoClass;
		$table = $dao::getTableName();
		$result = $dao::getAdapter()->insert($table, $this->_truncateToStructure());
		//odczyt id z sekwencji
		if ($result && property_exists($this, 'id') && $this->id === null) {
			$this->id = $dao::getAdapter()->lastInsertId($dao::getAdapter()->prepareSequenceName($table));
		}
		$this->_setSaveStatus(1);
		return true;
	}

	/**
	 * Aktualizacja danych (przez save)
	 * @return bool
	 */
	protected function _update() {
		$dao = $this->_daoClass;
		$bindKey = \Mmi\Db\Adapter\Pdo\PdoAbstract::generateRandomBindKey();
		$result = $dao::getAdapter()->update($dao::getTableName(), $this->_truncateToStructure(true), $this->_pkWhere($bindKey), array($bindKey => $this->getPk()));
		$this->_setSaveStatus(0);
		if ($result > 0) {
			$this->_setSaveStatus(1);
		}
		return ($result >= 0);
	}

	/**
	 * Obcina nadmiarowe dane w obiekcie zgodnie ze strukturą bazy danych
	 * @param bool $modifiedOnly tylko zmodyfikowane
	 * @return array
	 */
	protected final function _truncateToStructure($modifiedOnly = false) {
		$tableData = array();
		$dao = $this->_daoClass;
		$structure = $dao::getTableStructure();
		foreach ($this as $field => $value) {
			if (!isset($structure[$field])) {
				$field = \Mmi\Dao::convertCamelcaseToUnderscore($field);
				if (!isset($structure[$field])) {
					continue;
				}
			}
			if ($modifiedOnly && !$this->isModified($field)) {
				continue;
			}
			//próba zapisania nullowej wartości do nie nullowej kolumny (ID)
			if ($value === null && !$structure[$field]['null']) {
				continue;
			}
			$tableData[$field] = $value;
		}
		return $tableData;
	}

	/**
	 * Ustawia status zapisu
	 * @param int $status status
	 * @return \Mmi\Dao\Record
	 */
	protected final function _setSaveStatus($status) {
		$this->_saveStatus = $status;
		return $this;
	}

}