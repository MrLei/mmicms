<?php

/**
 * Mmi
 *
 * LICENSE
 *
 * Ten plik źródłowy objęty jest licencją BSD bez klauzuli ogłoszeniowej.
 * Licencja jest dostępna pod adresem: http://milejko.com/new-bsd.txt
 * W przypadku problemów, prosimy o kontakt na adres mariusz@milejko.pl
 *
 * Mmi/Dao/Record/Ro.php
 * @category   Mmi
 * @package    Mmi_Dao
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    1.0.0
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

/**
 * Active record tylko do odczytu
 * @category   Mmi
 * @package    Mmi_Dao
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */
class Mmi_Dao_Record_Ro {

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
	 * Nazwa identyfikatora
	 * @var string
	 */
	protected $_pk = 'id';

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
	 * Flaga oznaczająca nowy obiekt
	 * @var bool
	 */
	protected $_new = true;

	/**
	 * Konstruktor
	 * @param mixed $pk klucz główny (wartość lub tablica wartości)
	 */
	public final function __construct($pk = null) {
		if ($this->_daoClass === null) {
			$this->_daoClass = substr(get_called_class(), 0, -6) . 'Dao';
		}
		if ($pk === null) {
			return;
		}
		//wczytanie danych do rekordu jeśli jest stworzony po ID
		$dao = $this->_daoClass;
		$bindKey = Mmi_Db_Adapter_Pdo_Abstract::generateRandomBindKey();
		$result = $dao::getAdapter()->select('*', $dao::getTableName(), $this->_pkWhere($bindKey), '', 1, null, array($bindKey => $pk));
		if (!is_array($result) || !isset($result[0])) {
			return;
		}
		$this->setFromArray($result[0])
			->clearModified()
			->setNew(false)
			->init();
	}

	/**
	 * Metoda programisty wykonywana na końcu konstruktora
	 */
	public function init() {
		
	}

	/**
	 * Ustawia stan obiektu nowy / nie nowy
	 * @param bool $new nowy
	 * @return Mmi_Dao_Record_Ro
	 */
	public final function setNew($new) {
		$this->_new = ($new === true) ? true : false;
		return $this;
	}

	/**
	 * Pobiera klucz główny (tabela jeśli wielokrotny)
	 * @return mixed klucz główny
	 */
	public final function getPk() {
		if (!property_exists($this, $this->_pk)) {
			return;
		}
		return $this->{$this->_pk};
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
		throw new Mmi_Dao_Record_Exception('Unable to get field: ' . $name);
	}

	/**
	 * Magicznie ustawia dane w rekordzie
	 * @param string $name nazwa
	 * @param mixed $value wartość
	 */
	public final function __set($name, $value) {
		throw new Mmi_Dao_Record_Exception('Unable to set field: ' . $name);
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
	 * @return Mmi_Dao_Record_Ro
	 */
	public final function setOption($name, $value) {
		$this->_options[$name] = $value;
		return $this;
	}

	/**
	 * Pobiera dołączony rekord (JOIN)
	 * @param string $tableName
	 * @return Mmi_Dao_Record_Ro
	 */
	public final function getJoined($tableName) {
		return isset($this->_joined[$tableName]) ? $this->_joined[$tableName] : null;
	}

	/**
	 * Ustawia dane w obiekcie na podstawie tabeli
	 * @param array $row tabela z danymi
	 * @param bool $fromDb czy z bazy danych
	 * @return Mmi_Dao_Record_Ro
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
			$field = Mmi_Dao::convertUnderscoreToCamelcase($key);
			if (property_exists($this, $field)) {
				$this->$field = $value;
				continue;
			}
			$this->setOption($field, $value);
		}
		//podpięcie joinów pod główny rekord
		foreach ($joinedRows as $tableName => $rows) {
			$recordName = Mmi_Dao::getRecordNameByTable($tableName);
			$record = new $recordName;
			$record->setFromArray($rows);
			$this->_joined[$tableName] = $record;
		}
		return $this;
	}

	/**
	 * Usuwa flagę modyfikacji na polu, lub wszyskich polach
	 * @param string $field nazwa pola, jeśli null czyści wszystkie
	 * @return Mmi_Dao_Record_Ro
	 */
	public final function clearModified($field = null) {
		if ($field === null) {
			foreach ($this as $name => $value) {
				$this->_state[$name] = $value;
			}
			return $this;
		}
		$this->_state[$field] = $this->$field;
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
			if ($value instanceof Mmi_Dao_Record_Ro) {
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
		return 'WHERE ' . $dao::getAdapter()->prepareField($this->_pk) . ' = :' . $bindKey;
	}

}
