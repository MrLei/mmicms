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
	protected final function __construct($daoClassName = null) {
		$this->_compile = new Mmi_Dao_Query_Compile();
		if ($daoClassName !== null) {
			$this->_daoClassName = $daoClassName;
			return;
		}
		if ($this->_daoClassName !== null) {
			return;
		}
		$this->_daoClassName = substr(get_called_class(), 0, -5) . 'Dao';
	}
	
	/**
	 * Zwraca instancję siebie
	 * @return self
	 */
	public static function factory($daoClassName = null) {
		return new self($daoClassName);
	}

	/**
	 * Ustawia limit
	 * @param int $limit
	 * @return Mmi_Dao_Query
	 */
	public final function limit($limit = null) {
		$this->_compile->limit = $limit;
		return $this;
	}

	/**
	 * Ustawia ofset
	 * @param int $offset
	 * @return Mmi_Dao_Query
	 */
	public final function offset($offset = null) {
		$this->_compile->offset = $offset;
		return $this;
	}

	/**
	 * Sortowanie rosnące
	 * @param string $fieldName nazwa pola
	 * @param string $tableName opcjonalna nazwa tabeli źródłowej
	 * @return Mmi_Dao_Query
	 */
	public final function orderAsc($fieldName, $tableName = null) {
		return $this->_prepareOrder($fieldName, $tableName);
	}

	/**
	 * Sortowanie malejące
	 * @param string $fieldName nazwa pola
	 * @param string $tableName opcjonalna nazwa tabeli źródłowej
	 * @return Mmi_Dao_Query
	 */
	public final function orderDesc($fieldName, $tableName = null) {
		return $this->_prepareOrder($fieldName, $tableName, false);
	}

	/**
	 * Dodaje podsekcję AND
	 * @param Mmi_Dao_Query $query
	 * @return Mmi_Dao_Query
	 */
	public final function andQuery(Mmi_Dao_Query $query) {
		return $this->_mergeQueries($query, true);
	}

	/**
	 * Dodaje podsekcję WHERE (jak AND)
	 * @param Mmi_Dao_Query $query
	 * @return Mmi_Dao_Query
	 */
	public final function whereQuery(Mmi_Dao_Query $query) {
		return $this->andQuery($query);
	}

	/**
	 * Dodaje podsekcję OR
	 * @param Mmi_Dao_Query $query
	 * @return Mmi_Dao_Query
	 */
	public final function orQuery(Mmi_Dao_Query $query) {
		return $this->_mergeQueries($query, false);
	}

	/**
	 * Dodaje warunek na pole AND
	 * @param string $fieldName nazwa pola
	 * @param string $tableName opcjonalna nazwa tabeli źródłowej
	 * @return Mmi_Dao_Query_Field
	 */
	public final function andField($fieldName, $tableName = null) {
		return new Mmi_Dao_Query_Field($this, $this->_prepareField($fieldName, $tableName), 'AND');
	}

	/**
	 * Pierwszy warunek w zapytaniu (domyślnie AND)
	 * @param string $fieldName nazwa pola
	 * @param string $tableName opcjonalna nazwa tabeli źródłowej
	 * @return Mmi_Dao_Query_Field
	 */
	public final function where($fieldName, $tableName = null) {
		return $this->andField($fieldName, $tableName);
	}

	/**
	 * Dodaje warunek na pole OR
	 * @param string $fieldName nazwa pola
	 * @param string $tableName opcjonalna nazwa tabeli źródłowej
	 * @return Mmi_Dao_Query_Field
	 */
	public final function orField($fieldName, $tableName = null) {
		return new Mmi_Dao_Query_Field($this, $this->_prepareField($fieldName, $tableName), 'OR');
	}

	/**
	 * Dołącza tabelę tabelę
	 * @param string $tableName nazwa tabeli
	 * @param string $targetTableName opcjonalnie nazwa tabeli do której łączyć
	 * @return Mmi_Dao_Query_Join
	 */
	public final function join($tableName, $targetTableName = null) {
		return new Mmi_Dao_Query_Join($this, $tableName, 'JOIN', $targetTableName);
	}

	/**
	 * Dołącza tabelę złączeniem lewym
	 * @param string $tableName nazwa tabeli
	 * @param string $targetTableName opcjonalnie nazwa tabeli do której łączyć
	 * @return Mmi_Dao_Query_Join
	 */
	public final function joinLeft($tableName, $targetTableName = null) {
		return new Mmi_Dao_Query_Join($this, $tableName, 'LEFT JOIN', $targetTableName);
	}
	
	/**
	 * Pobiera ilość rekordów
	 * @return int
	 */
	public final function count() {
		$dao = $this->_daoClassName;
		$result = $dao::getAdapter()->select('COUNT(*)', $this->_prepareFrom(), $this->_compile->where, '', null, null, $this->_compile->bind);
		return isset($result[0]) ? current($result[0]) : 0;
	}
	
	/**
	 * Pobiera wszystkie rekordy i zwraca ich kolekcję
	 * @param Mmi_Dao_Query $q Obiekt zapytania
	 * @return Mmi_Dao_Record_Collection
	 */
	public final function find() {
		$dao = $this->_daoClassName;
		$result = $dao::getAdapter()->select($this->_prepareFields(), $this->_prepareFrom(), $this->_compile->where, $this->_compile->order, $this->_compile->limit, $this->_compile->offset, $this->_compile->bind);
		$recordName = $dao::getRecordName();
		$records = array();
		foreach ($result as $row) {
			$record = new $recordName();
			/* @var $record Mmi_Dao_Record */
			$record->setFromArray($row)->clearModified()->setNew(false);
			$records[] = $record;
		}
		$collectionName = $dao::getCollectionName();
		return new $collectionName($records);
	}
	
	/**
	 * Pobiera obiekt pierwszy ze zbioru
	 * @param Mmi_Dao_Query $q Obiekt zapytania
	 * @return Mmi_Dao_Record_Ro
	 */
	public final function findFirst() {
		$dao = $this->_daoClassName;
		$result = $dao::getAdapter()->select($this->_prepareFields(), $this->_prepareFrom(), $this->_compile->where, $this->_compile->order, 1, $this->_compile->offset, $this->_compile->bind);
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
		$dao = $this->_daoClassName;
		/* @var $db Mmi_Db_Adapter_Pdo_Abstract */
		$db = $dao::getAdapter();
		$data = $dao::getAdapter()->select($db->prepareField($keyName) . ', ' . $db->prepareField($valueName), $this->_prepareFrom(), $this->_compile->where, $this->_compile->order, $this->_compile->limit, $this->_compile->offset, $this->_compile->bind);
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
		$dao = $this->_daoClassName;
		$result = $dao::getAdapter()->select('MAX(' . $dao::getAdapter()->prepareField($keyName) . ')', $this->_prepareFrom(), $this->_compile->where, $this->_compile->order, 1, null, $this->_compile->bind);
		return isset($result[0]) ? current($result[0]) : null;
	}
	
	/**
	 * Pobiera wartość minimalną z kolumny
	 * @param string $keyName nazwa klucza
	 * @param Mmi_Dao_Query $q Obiekt zapytania
	 * @return string wartość minimalna
	 */
	public final function findMin($keyName) {
		$dao = $this->_daoClassName;
		$result = $dao::getAdapter()->select('MIN(' . $dao::getAdapter()->prepareField($keyName) . ')', $this->_prepareFrom(), $this->_compile->where, $this->_compile->order, 1, null, $this->_compile->bind);
		return isset($result[0]) ? current($result[0]) : null;
	}
	
	/**
	 * Pobiera unikalne wartości kolumny
	 * @param string $keyName nazwa klucza
	 * @return array mixed wartości unikalne
	 */
	public final function findUnique($keyName) {
		$dao = $this->_daoClassName;
		$data = $dao::getAdapter()->select('DISTINCT(' . $dao::getAdapter()->prepareField($keyName) . ')', $this->_prepareFrom(), $this->_compile->where, $this->_compile->order, 1, null, $this->_compile->bind);
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
	public final function getQueryCompile() {
		return $this->_compile;
	}

	/**
	 * Zwraca skrót MD5 zapytania
	 * @return string
	 */
	public final function getQueryCompileHash() {
		return md5(print_r($this->_compile, true));
	}
	
	/**
	 * Zwraca nazwę klasy DAO
	 * @return string
	 */
	public final function getDaoClassName() {
		return $this->_daoClassName;
	}
	
	/**
	 * Resetuje sortowanie w zapytaniu
	 * @return Mmi_Dao_Query
	 */
	public final function resetOrder() {
		$this->_compile->order = '';
		return $this;
	}
	
	/**
	 * Resetuje warunki w zapytaniu
	 * @return Mmi_Dao_Query
	 */
	public final function resetWhere() {
		$this->_compile->where = '';
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
		/* @var $db Mmi_Db_Adapter_Pdo_Abstract */
		$db = $dao::getAdapter();
		$tablePrefix = $db->prepareTable(($tableName === null) ? $dao::getTableName() : $tableName);
		if ($dao::fieldInTable($fieldName, $tableName) || $fieldName == 'RAND()') {
			return $tablePrefix . '.' . $db->prepareField($fieldName);
		}
		/* @var $db Mmi_Db_Adapter_Pdo_Abstract */
		$convertedFieldName = Mmi_Dao::convertCamelcaseToUnderscore($fieldName);
		if ($dao::fieldInTable($convertedFieldName, $tableName)) {
			return $tablePrefix . '.' . $db->prepareField($convertedFieldName);
		}
		throw new Exception(get_called_class() . ': "' . $fieldName . '" not found in ' . ($tableName !== null ? '"' . $tableName . '" table' : '"' . $dao::getTableName() . '"' . ' table'));
	}

	/**
	 * Przygotowuje order
	 * @param string $fieldName
	 * @param string $tableName
	 * @param boolean $asc
	 * @return Mmi_Dao_Query
	 */
	protected final function _prepareOrder($fieldName, $tableName = null, $asc = true) {
		if (!$this->_compile->order) {
			$this->_compile->order = 'ORDER BY ';
		} else {
			$this->_compile->order .= ', ';
		}
		$this->_compile->order .= $this->_prepareField($fieldName, $tableName) . ' ' . ($asc ? 'ASC' : 'DESC');
		return $this;
	}
	
	/**
	 * Przygotowuje pola do selecta
	 * @return string
	 */
	protected final function _prepareFields() {
		if (empty($this->_compile->joinSchema)) {
			return '*';
		}
		$fields = '';
		$dao = $this->_daoClassName;
		/* @var $db Mmi_Db_Adapter_Pdo_Abstract */
		$db = $dao::getAdapter();
		$mainStructure = $dao::getTableStructure();
		$table = $db->prepareTable($dao::getTableName());
		foreach ($mainStructure as $fieldName => $info) {
			$fields .=  $table. '.' . $db->prepareField($fieldName) . ', ';
		}
		foreach ($this->_compile->joinSchema as $tableName => $schema) {
			unset($schema);
			$structure = $dao::getTableStructure($tableName);
			$joinedTable = $db->prepareTable($tableName);
			foreach ($structure as $fieldName => $info) {
				$fields .= $joinedTable . '.' . $db->prepareField($fieldName) . ' AS ' . $db->prepareField($tableName . '__' . $fieldName) . ', ';
			}
		}
		return rtrim($fields, ', ');
	}
	
	protected final function _prepareFrom() {
		$dao = $this->_daoClassName;
		/* @var $db Mmi_Db_Adapter_Pdo_Abstract */
		$db = $dao::getAdapter();
		$table = $db->prepareTable($dao::getTableName());
		if (empty($this->_compile->joinSchema)) {
			return $table;
		}
		foreach ($this->_compile->joinSchema as $joinTable => $condition) {
			$targetTable = isset($condition[2]) ? $condition[2] : $table;
			$joinType = isset($condition[3]) ? $condition[3] : 'JOIN';
			$table .= ' ' . $joinType . ' ' . $db->prepareTable($joinTable) . ' ON ' .
				$db->prepareTable($joinTable) . '.' . $db->prepareField($condition[0]) .
				' = ' . $db->prepareTable($targetTable) . '.' . $db->prepareField($condition[1]);
		}
		return $table;
	}
	
	/**
	 * Łączy query
	 * @param boolean $type
	 * @return Mmi_Dao_Query
	 */
	protected final function _mergeQueries(Mmi_Dao_Query $query, $and = true) {
		$compilation = $query->getQueryCompile();
		//łączenie where
		if ($compilation->where) {
			$connector = $this->_compile->where ? ($and ? ' AND (' : ' OR (') : 'WHERE (';
			$this->_compile->where .=  $connector . substr($compilation->where, 6) . ')';
		}
		//@TODO: mogą pojawić się duplikaty pól
		if (!empty($compilation->bind)) {
			$this->_compile->bind = array_merge($compilation->bind, $this->_compile->bind);
		}
		//suma joinów query nadrzędnej i podrzędnej
		if (!empty($compilation->joinSchema)) {
			$this->_compile->joinSchema = array_merge($this->_compile->joinSchema, $compilation->joinSchema);
		}
		//łączenie order
		if ($compilation->order) {
			$this->_compile->order .= substr($compilation->order, 9);
		}
		return $this;
	}

}
