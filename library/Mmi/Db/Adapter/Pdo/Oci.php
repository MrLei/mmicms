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
 * Mmi/Db/Adapter/Pdo/Oci.php
 * @category   Mmi
 * @package    Mmi_Db
 * @subpackage Adapter
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @author     Michał Pawłowski <mpawlowski@live.com>
 * @version    1.0.0
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

/**
 * Klasa adaptera Oracle SQL
 * @category   Mmi
 * @package    Mmi_Db
 * @subpackage Adapter
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */
class Mmi_Db_Adapter_Pdo_Oci extends Mmi_Db_Adapter_Pdo_Abstract {

	/**
	 * Ustawia schemat
	 * @param string $schemaName nazwa schematu
	 */
	public function selectSchema($schemaName) {
		//oracle nie obsługuje schematów - bazy są selectowane po nazwie użytkownika; owner = schema
		$this->_config->schema = $schemaName;
	}

	/**
	 * Ustawia domyślne parametry dla importu (długie zapytania)
	 */
	public function setDefaultImportParams() {
		//dostępne parametry - query: SHOW PARAMETERS
		
	}

	/**
	 * Tworzy połączenie z bazą danych
	 */
	public function connect() {
		$this->_config->port = $this->_config->port ? $this->_config->port : 5432;
		$this->_config->charset = $this->_config->charset ? $this->_config->charset : 'utf8';
		parent::connect();
		if ($this->_config->schema) {
			$this->selectSchema($this->_config->schema);
		}
		$this->query('ALTER SESSION SET NLS_TIMESTAMP_FORMAT = "YYYY-MM-DD HH24:MI:SS"');
	}

	/**
	 * Otacza nazwę pola odpowiednimi znacznikami
	 * @param string $fieldName nazwa pola
	 * @return string
	 */
	public function prepareField($fieldName) {
		//dla oracle "
		if (strpos($fieldName, '"') === false) {
			return '"' . str_replace('.', '"."', $fieldName) . '"';
		}
		return $fieldName;
	}

	/**
	 * Otacza nazwę tabeli odpowiednimi znacznikami
	 * @param string $tableName nazwa tabeli
	 * @return string
	 */
	public function prepareTable($tableName) {
		//dla oracle tak jak pola
		return $this->prepareField($tableName);
	}

	/**
	 * Pobieranie rekordów
	 * @param string $fields pola do wybrania
	 * @param string $from część zapytania po FROM
	 * @param string $where warunek
	 * @param string $order sortowanie
	 * @param int $limit limit
	 * @param int $offset ofset
	 * @param array $whereBind parametry
	 * @return array
	 */
	public function select($fields = '*', $from = '', $where = '', $order = '', $limit = null, $offset = null, array $whereBind = array()) {
		$sql = 'SELECT' .
			' ' . $fields . 
			' FROM' . 
			' ' . $from . 
			' ' . $where . 
			' ' . $order;
		
		if ($limit > 0) {
			$sql = 'SELECT * FROM (' . $sql . ') WHERE ROWNUM  <= ' . intval($limit);
		}
		
		if ($offset > 0) {
			$sql = 'SELECT * FROM (SELECT a.*, ROWNUM rnum FROM (' . $sql . ')' .
				' A WHERE ROWNUM <= ' . (intval($limit) + intval($offset)) . ')' .
				' WHERE rnum  > ' . intval($offset);
		}
		
		return $this->fetchAll($sql, $whereBind);
	}
	
	/**
	 * Zwraca ostatnio wstawione ID
	 * @param string $name opcjonalnie nazwa serii (ważne w PostgreSQL)
	 * @return mixed
	 */
	public function lastInsertId($name = null) {
		if (!$this->_connected) {
			$this->connect();
		}
		$lastID = "-1";
		$resp = $this->fetchAll('SELECT "' . $name . '".CURRVAL FROM DUAL');
		foreach ($resp as $column) {
			$lastID = $column['CURRVAL'];
		}
		return $lastID;
	}

	/**
	 * Tworzy warunek limit
	 * @param int $limit
	 * @param int $offset
	 * @return string
	 */
	public function prepareLimit($limit = null, $offset = null) {
		//oracle nie obsługuje funkcji limit
		return "";
	}

	/**
	 * Tworzy konstrukcję sprawdzającą null w silniku bazy danych
	 * @param string $fieldName nazwa pola
	 * @param boolean $positive sprawdza czy null, lub czy nie null
	 * @return string
	 */
	public function prepareNullCheck($fieldName, $positive = true) {
		if ($positive) {
			return $fieldName . ' IS NULL';
		}
		return $fieldName . ' IS NOT NULL';
	}

	/**
	 * Zwraca informację o kolumnach tabeli
	 * @param string $tableName nazwa tabeli
	 * @param array $schema schemat
	 * @return array
	 */
	public function tableInfo($tableName, $schema = null) {
		$tableInfo = $this->fetchAll('SELECT "COLUMN_NAME" as "name", "DATA_TYPE" AS "dataType", "DATA_LENGTH" AS "maxLength", "NULLABLE" AS "null", "DATA_DEFAULT" AS "default" 
			FROM "ALL_TAB_COLS" 
			WHERE "TABLE_NAME" = :name AND "OWNER" = :schema
			ORDER BY "COLUMN_ID"', array(
					':name' => $tableName,
					':schema' => ($schema) ? $schema : ($this->_config->schema ? $this->_config->schema : $this->_config->name)
			));
		return $this->_associateTableMeta($tableInfo);
	}

	/**
	 * Listuje tabele w schemacie bazy danych
	 * @param string $schema
	 * @return array
	 */
	public function tableList($schema = null) {
		$list = $this->fetchAll('SELECT "TABLE_NAME" as "name" 
			FROM SYS.ALL_TABLES 
			WHERE "OWNER" = \':schema\' 
			ORDER BY "TABLE_NAME"', array(
				':schema' => ($schema) ? $schema : ($this->_config->schema ? $this->_config->schema : $this->_config->name))
			);
		$tables = array();
		foreach ($list as $row) {
			$tables[] = $row['name'];
		}
		return $tables;
	}
	
	/**
	 * Tworzy konstrukcję sprawdzającą ILIKE, jeśli dostępna w silniku
	 * @param string $fieldName nazwa pola
	 * @return string
	 */
	public function prepareIlike($fieldName) {
		return 'CAST(' . $fieldName . ' AS text) ILIKE';
	}
	
	/**
	 * Konwertuje do tabeli asocjacyjnej meta dane tabel
	 * @param array $meta meta data
	 * @return array
	 */
	protected function _associateTableMeta(array $meta) {
		$associativeMeta = array();
		foreach ($meta as $column) {
			$associativeMeta[$column['name']] = array(
				'dataType' => $column['dataType'],
				'maxLength' => $column['maxLength'],
				'null' => ($column['null'] == 'Y') ? true : false,
				'default' => $column['default']
			);
		}
		return $associativeMeta;
	}

}
