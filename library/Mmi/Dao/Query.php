<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Mmi\Dao;

/**
 * Klasa zapytania powoływana przez Query::factory()
 * umożliwia odpytywanie DAO o Rekordy
 * rozszerza bazowe query o możliwość wykonywania zapytań wyszukujących
 */
class Query extends Query\Base {

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
	 * Pobiera pierwszy rekord po kluczu głównym ID
	 * null jeśli brak danych
	 * @param int $id
	 * @return \Mmi\Dao\Record
	 */
	public final function findPk($id) {
		//zwróci null jeśli brak danych
		return $this->where('id')->equals($id)
				->findFirst();
	}

	/**
	 * Pobiera wszystkie rekordy i zwraca ich kolekcję
	 * @param \Mmi\Dao\Query $q Obiekt zapytania
	 * @return \Mmi\Dao\Record\Collection
	 */
	public final function find() {
		$dao = $this->_daoClassName;
		//odpytanie DAO
		$result = $dao::getAdapter()->select($this->_prepareFields(), $this->_prepareFrom(), $this->_compile->where, $this->_compile->order, $this->_compile->limit, $this->_compile->offset, $this->_compile->bind);
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
		$dao = $this->_daoClassName;
		//zapytanie do DAO
		$result = $dao::getAdapter()->select($this->_prepareFields(), $this->_prepareFrom(), $this->_compile->where, $this->_compile->order, 1, $this->_compile->offset, $this->_compile->bind);
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
		$dao = $this->_daoClassName;
		/* @var $db \Mmi\Db\Adapter\Pdo\PdoAbstract */
		$db = $dao::getAdapter();
		//zapytanie do DAO
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
	 * @param \Mmi\Dao\Query $q Obiekt zapytania
	 * @return string wartość maksymalna
	 */
	public final function findMax($keyName) {
		$dao = $this->_daoClassName;
		//zapytanie do DAO
		$result = $dao::getAdapter()->select('MAX(' . $dao::getAdapter()->prepareField($keyName) . ')', $this->_prepareFrom(), $this->_compile->where, $this->_compile->order, 1, null, $this->_compile->bind);
		return isset($result[0]) ? current($result[0]) : null;
	}

	/**
	 * Pobiera wartość minimalną z kolumny
	 * @param string $keyName nazwa klucza
	 * @param \Mmi\Dao\Query $q Obiekt zapytania
	 * @return string wartość minimalna
	 */
	public final function findMin($keyName) {
		$dao = $this->_daoClassName;
		//zapytanie do DAO
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
		//zapytanie do DAO
		$data = $dao::getAdapter()->select('DISTINCT(' . $dao::getAdapter()->prepareField($keyName) . ')', $this->_prepareFrom(), $this->_compile->where, $this->_compile->order, null, null, $this->_compile->bind);
		$result = array();
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
		if (empty($this->_compile->joinSchema)) {
			return '*';
		}
		$fields = '';
		$dao = $this->_daoClassName;
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
		foreach ($this->_compile->joinSchema as $tableName => $schema) {
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

	protected final function _prepareFrom() {
		$dao = $this->_daoClassName;
		/* @var $db \Mmi\Db\Adapter\Pdo\PdoAbstract */
		$db = $dao::getAdapter();
		$table = $db->prepareTable($dao::getTableName());
		//jeśli brak joinów sama tabela
		if (empty($this->_compile->joinSchema)) {
			return $table;
		}
		$baseTable = $table;
		//przygotowanie joinów
		foreach ($this->_compile->joinSchema as $joinTable => $condition) {
			$targetTable = isset($condition[2]) ? $condition[2] : $baseTable;
			$joinType = isset($condition[3]) ? $condition[3] : 'JOIN';
			$table .= ' ' . $joinType . ' ' . $db->prepareTable($joinTable) . ' ON ' .
				$db->prepareTable($joinTable) . '.' . $db->prepareField($condition[0]) .
				' = ' . $db->prepareTable($targetTable) . '.' . $db->prepareField($condition[1]);
		}
		return $table;
	}

}
