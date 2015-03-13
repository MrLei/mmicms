<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Mmi\Dao\Query;

class Data {

	/**
	 * Obiekt zapytania
	 * @var \Mmi\Dao\Query
	 */
	protected $_query;

	/**
	 * Konstruktor
	 * @param \Mmi\Dao\Query $query
	 */
	public function __construct(\Mmi\Dao\Query $query) {
		$this->_query = $query;
	}

	/**
	 * Fabryka obiektów
	 * @param \Mmi\Dao\Query $query
	 * @return \Mmi\Dao\Query
	 */
	public static function factory(\Mmi\Dao\Query $query) {
		return new self($query);
	}

	/**
	 * Pobiera ilość rekordów
	 * @return int
	 */
	public final function count() {
		$dao = $this->_query->getDaoClassName();
		//wykonanie zapytania zliczającego na adapter
		$result = $dao::getAdapter()->select('COUNT(*)', $this->_prepareFrom(), $this->_query->getQueryCompile()->where, '', null, null, $this->_query->getQueryCompile()->bind);
		return isset($result[0]) ? current($result[0]) : 0;
	}

	/**
	 * Pobiera wszystkie rekordy i zwraca ich kolekcję
	 * @return \Mmi\Dao\Record\Collection
	 */
	public final function find() {
		$dao = $this->_query->getDaoClassName();
		//odpytanie adaptera o rekordy
		$result = $dao::getAdapter()->select($this->_prepareFields(), $this->_prepareFrom(), $this->_query->getQueryCompile()->where, $this->_query->getQueryCompile()->order, $this->_query->getQueryCompile()->limit, $this->_query->getQueryCompile()->offset, $this->_query->getQueryCompile()->bind);
		//ustalenie klasy rekordu
		$recordName = $dao::getRecordName();
		$records = array();
		//tworzenie rekordów
		foreach ($result as $row) {
			$record = new $recordName();
			/* @var $record \Mmi\Dao\Record */
			$record->setFromArray($row)->clearModified();
			$records[] = $record;
		}
		//ustalenie klasy kolekcji rekordów
		$collectionName = $dao::getCollectionName();
		//zwrot kolekcji
		return new $collectionName($records);
	}

	/**
	 * Pobiera obiekt pierwszy ze zbioru
	 * null jeśli brak danych
	 * @param \Mmi\Dao\Query $q Obiekt zapytania
	 * @return \Mmi\Dao\Record\Ro
	 */
	public final function findFirst() {
		$dao = $this->_query->getDaoClassName();
		//odpytanie adaptera o rekordy
		$result = $dao::getAdapter()->select($this->_prepareFields(), $this->_prepareFrom(), $this->_query->getQueryCompile()->where, $this->_query->getQueryCompile()->order, 1, $this->_query->getQueryCompile()->offset, $this->_query->getQueryCompile()->bind);
		//null jeśli brak danych
		if (!is_array($result) || !isset($result[0])) {
			return null;
		}
		//ustalenie klasy rekordu
		$recordName = $dao::getRecordName();
		/* @var $record \Mmi\Dao\Record\Ro */
		$record = new $recordName;
		return $record->setFromArray($result[0])->clearModified();
	}

	/**
	 * Zwraca tablicę asocjacyjną (pary)
	 * @param string $keyName
	 * @param string $valueName
	 * @return array
	 */
	public final function findPairs($keyName, $valueName) {
		$dao = $this->_query->getDaoClassName();
		/* @var $db \Mmi\Db\Adapter\Pdo\PdoAbstract */
		$db = $dao::getAdapter();
		//odpytanie adaptera o rekordy
		$data = $dao::getAdapter()->select($db->prepareField($keyName) . ', ' . $db->prepareField($valueName), $this->_prepareFrom(), $this->_query->getQueryCompile()->where, $this->_query->getQueryCompile()->order, $this->_query->getQueryCompile()->limit, $this->_query->getQueryCompile()->offset, $this->_query->getQueryCompile()->bind);
		$kv = array();
		foreach ($data as $line) {
			//przy wybieraniu tych samych pól tabela ma tylko jeden wiersz
			if (count($line) == 1) {
				$line = current($line);
			}
			//klucz to pierwszy element, wartość - drugi
			$kv[current($line)] = next($line);
		}
		return $kv;
	}

	/**
	 * Pobiera wartość maksymalną z kolumny
	 * @param string $keyName nazwa klucza
	 * @return string wartość maksymalna
	 */
	public final function findMax($keyName) {
		$dao = $this->_query->getDaoClassName();
		//odpytanie adaptera o rekord
		$result = $dao::getAdapter()->select('MAX(' . $dao::getAdapter()->prepareField($keyName) . ')', $this->_prepareFrom(), $this->_query->getQueryCompile()->where, $this->_query->getQueryCompile()->order, 1, null, $this->_query->getQueryCompile()->bind);
		return isset($result[0]) ? current($result[0]) : null;
	}

	/**
	 * Pobiera wartość minimalną z kolumny
	 * @param string $keyName nazwa klucza
	 * @return string wartość minimalna
	 */
	public final function findMin($keyName) {
		$dao = $this->_query->getDaoClassName();
		//odpytanie adaptera o rekord
		$result = $dao::getAdapter()->select('MIN(' . $dao::getAdapter()->prepareField($keyName) . ')', $this->_prepareFrom(), $this->_query->getQueryCompile()->where, $this->_query->getQueryCompile()->order, 1, null, $this->_query->getQueryCompile()->bind);
		return isset($result[0]) ? current($result[0]) : null;
	}

	/**
	 * Pobiera unikalne wartości kolumny
	 * @param string $keyName nazwa klucza
	 * @return array mixed wartości unikalne
	 */
	public final function findUnique($keyName) {
		$dao = $this->_query->getDaoClassName();
		//odpytanie adaptera o rekordy
		$data = $dao::getAdapter()->select('DISTINCT(' . $dao::getAdapter()->prepareField($keyName) . ')', $this->_prepareFrom(), $this->_query->getQueryCompile()->where, $this->_query->getQueryCompile()->order, null, null, $this->_query->getQueryCompile()->bind);
		$result = array();
		//dodaje kolejne wartości do tablicy
		foreach ($data as $line) {
			$result[] = current($line);
		}
		return $result;
	}

	/**
	 * Przygotowuje pola do selecta
	 * @return string
	 */
	protected final function _prepareFields() {
		//jeśli pusty schemat połączeń
		if (empty($this->_query->getQueryCompile()->joinSchema)) {
			return '*';
		}
		$fields = '';
		$dao = $this->_query->getDaoClassName();
		/* @var $db \Mmi\Db\Adapter\Pdo\PdoAbstract */
		$db = $dao::getAdapter();
		//pobranie struktury tabeli
		$mainStructure = $dao::getTableStructure();
		$table = $db->prepareTable($dao::getTableName());
		//pola z tabeli głównej
		foreach ($mainStructure as $fieldName => $info) {
			$fields .= $table . '.' . $db->prepareField($fieldName) . ', ';
		}
		//pola z tabel dołączonych
		foreach ($this->_query->getQueryCompile()->joinSchema as $tableName => $schema) {
			//pobranie struktury tabeli dołączonej
			$structure = $dao::getTableStructure($tableName);
			$joinedTable = $db->prepareTable($tableName);
			//pola tabeli dołączonej
			foreach ($structure as $fieldName => $info) {
				$fields .= $joinedTable . '.' . $db->prepareField($fieldName) . ' AS ' . $db->prepareField($tableName . '__' . $fieldName) . ', ';
			}
		}
		return rtrim($fields, ', ');
	}

	/**
	 * Przygotowuje sekcję FROM
	 * @return string
	 */
	protected final function _prepareFrom() {
		$dao = $this->_query->getDaoClassName();
		/* @var $db \Mmi\Db\Adapter\Pdo\PdoAbstract */
		$db = $dao::getAdapter();
		$table = $db->prepareTable($dao::getTableName());
		//jeśli brak joinów sama tabela
		if (empty($this->_query->getQueryCompile()->joinSchema)) {
			return $table;
		}
		$baseTable = $table;
		//przygotowanie joinów
		foreach ($this->_query->getQueryCompile()->joinSchema as $joinTable => $condition) {
			$targetTable = isset($condition[2]) ? $condition[2] : $baseTable;
			$joinType = isset($condition[3]) ? $condition[3] : 'JOIN';
			$table .= ' ' . $joinType . ' ' . $db->prepareTable($joinTable) . ' ON ' .
				$db->prepareTable($joinTable) . '.' . $db->prepareField($condition[0]) .
				' = ' . $db->prepareTable($targetTable) . '.' . $db->prepareField($condition[1]);
		}
		return $table;
	}

}
