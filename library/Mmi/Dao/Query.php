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
 * Mmi/Dao/Query.php
 * @category   Mmi
 * @package    Mmi_Dao
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    1.0.0
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

/**
 * Klasa zapytania DAO
 * @category   Mmi
 * @package    Mmi_Dao
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */
class Mmi_Dao_Query {

	/**
	 * Kompilant zapytania
	 * @var Mmi_Dao_Query_Compile
	 */
	protected $_compile;
	
	/**
	 * Nazwa klasy DAO
	 * @var string
	 */
	protected $_daoClassName;

	/**
	 * Konstruktor tworzy nowe skompilowane zapytanie
	 * @param string $daoClassName nazwa klasy DAO
	 */
	public function __construct($daoClassName) {
		$this->_compile = new Mmi_Dao_Query_Compile();
		$this->_daoClassName = $daoClassName;
	}

	/**
	 * Ustawia limit
	 * @param int $limit
	 * @return Mmi_Dao_Query
	 */
	public function limit($limit = null) {
		$this->_compile->limit = $limit;
		return $this;
	}

	/**
	 * Ustawia ofset
	 * @param int $offset
	 * @return Mmi_Dao_Query
	 */
	public function offset($offset = null) {
		$this->_compile->offset = $offset;
		return $this;
	}

	/**
	 * Sortowanie rosnące
	 * @param string $fieldName nazwa pola
	 * @param string $tableName opcjonalna nazwa tabeli źródłowej
	 * @return Mmi_Dao_Query
	 */
	public function orderAsc($fieldName, $tableName = null) {
		$this->_compile->order[] = array($this->_prepareField($fieldName, $tableName), 'ASC', $tableName);
		return $this;
	}

	/**
	 * Sortowanie malejące
	 * @param string $fieldName nazwa pola
	 * @param string $tableName opcjonalna nazwa tabeli źródłowej
	 * @return Mmi_Dao_Query
	 */
	public function orderDesc($fieldName, $tableName = null) {

		$this->_compile->order[] = array($this->_prepareField($fieldName, $tableName), 'DESC', $tableName);
		return $this;
	}

	/**
	 * Dodaje podsekcję AND
	 * @param Mmi_Dao_Query $query
	 * @return Mmi_Dao_Query
	 */
	public function andQuery(Mmi_Dao_Query $query) {
		$bind = $query->queryCompilation()->bind;
		if (empty($bind)) {
			return $this;
		}
		$this->_compile->bind[] = array($bind, 'AND');
		return $this;
	}

	/**
	 * Dodaje podsekcję WHERE (jak AND)
	 * @param Mmi_Dao_Query $query
	 * @return Mmi_Dao_Query
	 */
	public function whereQuery(Mmi_Dao_Query $query) {
		return $this->andQuery($query);
	}

	/**
	 * Dodaje podsekcję OR
	 * @param Mmi_Dao_Query $query
	 * @return Mmi_Dao_Query
	 */
	public function orQuery(Mmi_Dao_Query $query) {
		$bind = $query->queryCompilation()->bind;
		if (empty($bind)) {
			return $this;
		}
		$this->_compile->bind[] = array($bind, 'OR');
		return $this;
	}

	/**
	 * Dodaje warunek na pole AND
	 * @param string $fieldName nazwa pola
	 * @param string $tableName opcjonalna nazwa tabeli źródłowej
	 * @return Mmi_Dao_Query_Field
	 */
	public function andField($fieldName, $tableName = null) {
		return new Mmi_Dao_Query_Field($this, $this->_prepareField($fieldName, $tableName), $tableName, 'AND');
	}

	/**
	 * Pierwszy warunek w zapytaniu (domyślnie AND)
	 * @param string $fieldName nazwa pola
	 * @param string $tableName opcjonalna nazwa tabeli źródłowej
	 * @return Mmi_Dao_Query_Field
	 */
	public function where($fieldName, $tableName = null) {
		return $this->andField($fieldName, $tableName);
	}

	/**
	 * Dodaje warunek na pole OR
	 * @param string $fieldName nazwa pola
	 * @param string $tableName opcjonalna nazwa tabeli źródłowej
	 * @return Mmi_Dao_Query_Field
	 */
	public function orField($fieldName, $tableName = null) {
		return new Mmi_Dao_Query_Field($this, $this->_prepareField($fieldName, $tableName), $tableName, 'OR');
	}

	/**
	 * Łączy tabelę
	 * @param string $tableName nazwa tabeli
	 * @param string $targetTableName opcjonalnie nazwa tabeli do której łączyć
	 * @return Mmi_Dao_Query_Join
	 */
	public function join($tableName, $targetTableName = null) {
		return new Mmi_Dao_Query_Join($this, $tableName, 'JOIN', $targetTableName);
	}

	/**
	 * Łączy tabelę złączeniem lewym
	 * @param string $tableName nazwa tabeli
	 * @param string $targetTableName opcjonalnie nazwa tabeli do której łączyć
	 * @return Mmi_Dao_Query_Join
	 */
	public function joinLeft($tableName, $targetTableName = null) {
		return new Mmi_Dao_Query_Join($this, $tableName, 'LEFT JOIN', $targetTableName);
	}
	
	/**
	 * Pobiera ilość rekordów
	 * @return int
	 */
	public final function count() {
		$compile = $this->queryCompilation();
		$dao = $this->_daoClassName;
		$result = $dao::getAdapter()->select($dao::getTableName(), $compile->bind, array(), null, null, array('COUNT(*)'), $compile->joinSchema);
		return isset($result[0]) ? current($result[0]) : 0;
	}
	
	/**
	 * Pobiera wszystkie rekordy i zwraca ich kolekcję
	 * @param Mmi_Dao_Query $q Obiekt zapytania
	 * @return Mmi_Dao_Record_Collection
	 */
	public final function find() {
		$compile = $this->queryCompilation();
		$dao = $this->_daoClassName;
		$result = $dao::getAdapter()->select($dao::getTableName(), $compile->bind, $compile->order, $compile->limit, $compile->offset, $this->_getFields($compile->joinSchema), $compile->joinSchema);
		$collectionName = $dao::getCollectionName();
		$collection = new $collectionName();
		$recordName = $dao::getRecordName();
		foreach ($result as $row) {
			$record = new $recordName();
			/* @var $record Mmi_Dao_Record */
			$record->setFromArray($row)->clearModified()->setNew(false);
			$collection->append($record);
		}
		return $collection;
	}
	
	/**
	 * Pobiera obiekt pierwszy ze zbioru
	 * @param Mmi_Dao_Query $q Obiekt zapytania
	 * @return Mmi_Dao_Record_Ro
	 */
	public final function findFirst() {
		$compile = $this->queryCompilation();
		$dao = $this->_daoClassName;
		$result = $dao::getAdapter()->select($dao::getTableName(), $compile->bind, $compile->order, 1, $compile->offset, $this->_getFields($compile->joinSchema), $compile->joinSchema);
		if (!is_array($result) || !isset($result[0])) {
			return null;
		}
		$recordName = $dao::getRecordName();
		/* @var $record Mmi_Dao_Record_Ro */
		$record = new $recordName;
		$record->setFromArray($result[0])->clearModified()->setNew(false);
		return $record;
	}
	
	/**
	 * Zwraca tablicę asocjacyjną (pary)
	 * @param string $keyName
	 * @param string $valueName
	 * @return array
	 */
	public final function findPairs($keyName, $valueName) {
		$compile = $this->queryCompilation();
		$dao = $this->_daoClassName;
		$data = $dao::getAdapter()->select($dao::getTableName(), $compile->bind, $compile->order, $compile->limit, $compile->offset, array($keyName, $valueName), $compile->joinSchema);
		$kv = array();
		foreach ($data as $line) {
			if (count($line) == 1) {
				$value = current($line);
				if (is_array($value) && count($value) == 2) {
					$kv[$value[0]] = $value[1];
					continue;
				}
				continue;
			}
			$kv[current($line)] = next($line);
		}
		return $kv;
	}
	
	/**
	 * Pobiera wartość maksymalną z kolumny
	 * @param string $keyName nazwa klucza
	 * @param Mmi_Dao_Query $q Obiekt zapytania
	 * @return string wartość maksymalna
	 */
	public final function findMax($keyName) {
		$compile = $this->queryCompilation();
		$dao = $this->_daoClassName;
		$result = $dao::getAdapter()->select($dao::getTableName(), $compile->bind, array(), 1, 0, array('MAX(' . $dao::getAdapter()->prepareField($keyName) . ')'), $compile->joinSchema);
		return isset($result[0]) ? current($result[0]) : null;
	}
	
	/**
	 * Pobiera wartość minimalną z kolumny
	 * @param string $keyName nazwa klucza
	 * @param Mmi_Dao_Query $q Obiekt zapytania
	 * @return string wartość minimalna
	 */
	public final function findMin($keyName) {
		$compile = $this->queryCompilation();
		$dao = $this->_daoClassName;
		$result = $dao::getAdapter()->select($dao::getTableName(), $compile->bind, array(), 1, 0, array('MIN(' . $dao::getAdapter()->prepareField($keyName) . ')'), $compile->joinSchema);
		return isset($result[0]) ? current($result[0]) : null;
	}
	
	/**
	 * Pobiera unikalne wartości kolumny
	 * @param string $keyName nazwa klucza
	 * @return array mixed wartości unikalne
	 */
	public final function findUnique($keyName) {
		$compile = $this->queryCompilation();
		$dao = $this->_daoClassName;
		$data = $dao::getAdapter()->select($dao::getTableName(), $compile->bind, $compile->order, $compile->limit, $compile->offset, array('DISTINCT(' . $dao::getAdapter()->prepareField($keyName) . ')'), $compile->joinSchema);
		$result = array();
		foreach ($data as $line) {
			$result[] = current($line);
		}
		return $result;
	}

	/**
	 * Zwraca skompilowane zapytanie
	 * @return Mmi_Dao_Query_Compile
	 */
	public function queryCompilation() {
		return $this->_compile;
	}

	/**
	 * Zwraca skrót MD5 zapytania
	 * @return string
	 */
	public function queryCompilationMd5() {
		return md5(print_r($this->_compile, true));
	}
	
	/**
	 * Resetuje sortowanie w zapytaniu
	 * @return Mmi_Dao_Query
	 */
	public function resetOrder() {
		$this->_compile->order = array();
		return $this;
	}
	
	/**
	 * Resetuje warunki w zapytaniu
	 * @return Mmi_Dao_Query
	 */
	public function resetWhere() {
		$this->_compile->bind = array();
		return $this;
	}
	
	/**
	 * Przygotowuje nazwę pola do zapytania, konwertuje camelcase na podkreślenia
	 * @param string $fieldName
	 * @param string $tableName
	 * @return string
	 * @throws Exception
	 */
	protected final function _prepareField($fieldName, $tableName = null) {
		$dao = $this->_daoClassName;
		if ($dao::fieldInTable($fieldName, $tableName)) {
			return $fieldName;
		}
		$convertedFieldName = Mmi_Dao::convertCamelcaseToUnderscore($fieldName);
		if ($dao::fieldInTable($convertedFieldName, $tableName)) {
			return $convertedFieldName;
		}
		throw new Exception(get_called_class() . ': "' . $fieldName . '" not found in ' . ($tableName !== null ? '"' . $tableName . '" table' : '"' . $dao::getTableName() . '"' . ' table'));
	}
	
	/**
	 * Zwraca pola do selecta
	 * @param array $joinSchema
	 * @return string
	 */
	protected function _getFields($joinSchema) {
		if (empty($joinSchema)) {
			return array('*');
		}
		$fields = array();
		$dao = $this->_daoClassName;
		$mainStructure = $dao::getTableStructure();
		foreach ($mainStructure as $field => $info) {
			$fields[] = $dao::getTableName() . '.' . $field;
		}
		foreach ($joinSchema as $tableName => $schema) {
			unset($schema);
			$structure = $dao::getTableStructure($tableName);
			foreach ($structure as $field => $info) {
				$fields[] = $tableName . '.' . $field . ' AS ' . $tableName . '__' . $field;
			}
		}
		return $fields;
	}

}
