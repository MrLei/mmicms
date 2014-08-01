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
	 * Przechowuje dane rekordu
	 * @var array
	 */
	protected $_data = array();

	/**
	 * Nazwa identyfikatora
	 * @var string
	 */
	protected $_pk = array('id');

	/**
	 * Zmodyfikowane klucze
	 * @var array
	 */
	protected $_modified = array();

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
		$result = $dao::getAdapter()->select($dao::getTableName(), $this->_pkBind($pk), array(), 1);
		if (!is_array($result) || !isset($result[0])) {
			return;
		}
		$this->setFromArray($result[0])->clearModified();
		$this->setNew(false);
		$this->init();
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
		$this->_new = false;
		if ($new === true) {
			$this->_new = true;
		}
		return $this;
	}

	/**
	 * Pobiera klucz główny (tabela jeśli wielokrotny)
	 * @return mixed klucz główny
	 */
	public final function getPk() {
		if (count($this->_pk) == 1) {
			return $this->__get($this->_pk[0]);
		}
		//klucz wielokrotny
		$pk = array();
		foreach ($this->_pk as $name) {
			$pk[] = $this->__get($name);
		}
		return $pk;
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
		return isset($this->_data[$name]) ? $this->_data[$name] : null;
	}

	/**
	 * Magicznie ustawia dane w rekordzie
	 * @param string $name nazwa
	 * @param mixed $value wartość
	 */
	public final function __set($name, $value) {
		$this->_modified[$name] = true;
		return $this->_data[$name] = $value;
	}

	/**
	 * Magicznie sprawdza czy istnieje wartość w danych rekordu
	 * @param string $name
	 * @return boolean
	 */
	public final function __isset($name) {
		return isset($this->_data[$name]);
	}

	/**
	 * Magicznie usuwa zmienną z rekordu
	 * @param string $name nazwa
	 */
	public final function __unset($name) {
		$this->_modified[$name] = true;
		unset($this->_data[$name]);
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
			$underline = strpos($key, '__');
			if (false !== $underline) {
				$joinedRows[substr($key, 0, $underline)][substr($key, $underline + 2)] = $value;
				continue;
			}
			$this->__set($key, $value);
		}
		foreach ($joinedRows as $table => $rows) {
			$ro = new Mmi_Dao_Record_Ro();
			$ro->setFromArray($rows)->clearModified();
			$this->__set($table, $ro);
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
			$this->_modified = array();
			return $this;
		}
		unset($this->_modified[$field]);
		return $this;
	}

	/**
	 * Zwraca dane z obiektu w postaci tablicy
	 * @return array
	 */
	public function toArray() {
		$array = array();
		foreach ($this->_data as $name => $value) {
			if ($value instanceof Mmi_Dao_Record_Ro) {
				$value = $value->toArray();
			}
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
	 * Zwraca bind do klucza głównego dla podanej tabeli wartości
	 * @param array $values
	 * @return array tablica bind
	 * @throws Exception
	 */
	protected final function _pkBind($values) {
		if (!is_array($values)) {
			$values = array($values);
		}
		$bind = array();
		foreach ($this->_pk as $index => $column) {
			if (!array_key_exists($index, $values)) {
				throw new Exception('Mmi_Dao_Record_Ro: Invalid primary key values: ' . $column . ' not found in ' . print_r($values, true) . $this->_daoClass);
			}
			$bind[] = array($column, $values[$index]);
		}
		return $bind;
	}

}