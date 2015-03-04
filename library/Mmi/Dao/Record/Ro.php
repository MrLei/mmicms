<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Mmi\Dao\Record;

class Ro {

	/**
	 * Przechowuje ekstra opcje rekordu
	 * @var array
	 */
	protected $_options = array();

	/**
	 * Przechowuje dołączone dane (JOIN)
	 * @var array
	 */
	protected $_joined = array();

	/**
	 * Stan rekordu przed modyfikacją
	 * @var array
	 */
	protected $_state = array();

	/**
	 * Nazwa klasy DAO
	 * @var string
	 */
	protected $_daoClass;

	/**
	 * Konstruktor
	 * @param mixed $id identyfikator do tworzenia obiektu
	 */
	public final function __construct($id = null) {
		if ($this->_daoClass === null) {
			$this->_daoClass = substr(get_called_class(), 0, -6) . 'Dao';
		}
		if ($id === null) {
			return;
		}
		$dao = $this->_daoClass;
		$query = $dao::getQueryName();
		if (null === ($record = $query::factory()->findPk($id))) {
			throw new ExceptionNotFound('Record not found: ' . $id);
		}
		$this->setFromArray($record->toArray())
			->clearModified()
			->init();
	}
	
	/**
	 * Metoda inicjująca (dla programisty końcowego)
	 */
	public function init() {
		
	}

	/**
	 * Pobiera klucz główny (tabela jeśli wielokrotny)
	 * @return mixed klucz główny
	 */
	public final function getPk() {
		if (!property_exists($this, 'id')) {
			return;
		}
		return $this->id;
	}

	/**
	 * Zwraca nazwę klasy DAO
	 * @return string
	 */
	public final function getDaoClassName() {
		return $this->_daoClass;
	}

	/**
	 * Magicznie pobiera dane z rekordu
	 * @param string $name nazwa
	 * @return mixed
	 */
	public final function __get($name) {
		throw new ExceptionField('Field not found: ' . $name);
	}

	/**
	 * Magicznie ustawia dane w rekordzie
	 * @param string $name nazwa
	 * @param mixed $value wartość
	 */
	public final function __set($name, $value) {
		throw new ExceptionField('Field not found: ' . $name);
	}

	/**
	 * Ustawia opcję w rekordzie
	 * @param string $name
	 * @return mixed
	 */
	public final function getOption($name) {
		return isset($this->_options[$name]) ? $this->_options[$name] : null;
	}

	/**
	 * Ustawia opcję w rekordzie
	 * @param string $name
	 * @param mixed $value
	 * @return \Mmi\Dao\Record\Ro
	 */
	public final function setOption($name, $value) {
		$this->_options[$name] = $value;
		return $this;
	}

	/**
	 * Pobiera dołączony rekord (JOIN)
	 * @param string $tableName
	 * @return \Mmi\Dao\Record\Ro
	 */
	public final function getJoined($tableName) {
		return isset($this->_joined[$tableName]) ? $this->_joined[$tableName] : null;
	}

	/**
	 * Ustawia dane w obiekcie na podstawie tabeli
	 * @param array $row tabela z danymi
	 * @param bool $fromDb czy z bazy danych
	 * @return \Mmi\Dao\Record\Ro
	 */
	public function setFromArray(array $row = array()) {
		$joinedRows = array();
		foreach ($row as $key => $value) {
			//przyjęcie pól z joinów
			if (false !== ($underline = strpos($key, '__'))) {
				$joinedRows[substr($key, 0, $underline)][substr($key, $underline + 2)] = $value;
				continue;
			}
			$dao = $this->_daoClass;
			$field = \Mmi\Dao::convertUnderscoreToCamelcase($key);
			if (property_exists($this, $field)) {
				$this->$field = $value;
				continue;
			}
			$this->setOption($field, $value);
		}
		//podpięcie joinów pod główny rekord
		foreach ($joinedRows as $tableName => $rows) {
			$recordName = \Mmi\Dao::getRecordNameByTable($tableName);
			$record = new $recordName;
			$record->setFromArray($rows);
			$this->_joined[$tableName] = $record;
		}
		return $this;
	}

	/**
	 * Usuwa flagę modyfikacji na polu, lub wszyskich polach
	 * @return \Mmi\Dao\Record\Ro
	 */
	public final function clearModified() {
		foreach ($this as $name => $value) {
			$this->_state[$name] = $value;
		}
		return $this;
	}

	/**
	 * Zwraca czy zmodyfikowano pole
	 * @param string $field nazwa pola
	 * @return boolean
	 */
	public final function isModified($field) {
		return !isset($this->_state[$field]) || ($this->_state[$field] !== $this->$field);
	}

	/**
	 * Zwraca dane z obiektu w postaci tablicy
	 * @return array
	 */
	public function toArray() {
		$array = array();
		foreach ($this->_options as $name => $value) {
			$array[$name] = $value;
		}
		foreach ($this->_joined as $name => $value) {
			if ($value instanceof \Mmi\Dao\Record\Ro) {
				$value = $value->toArray();
			}
			$array[$name] = $value;
		}
		foreach ($this as $name => $value) {
			$array[$name] = $value;
		}
		return $array;
	}

	/**
	 * Zwraca dane z obiektu w postaci JSON
	 * @return array
	 */
	public function toJson() {
		return json_encode($this->toArray());
	}

	/**
	 * WHERE po kluczu tabeli
	 * @param string $bindKey nazwa do binda
	 * @return string
	 */
	protected function _pkWhere($bindKey) {
		$dao = $this->_daoClass;
		return 'WHERE ' . $dao::getAdapter()->prepareField('id') . ' = :' . $bindKey;
	}

}
