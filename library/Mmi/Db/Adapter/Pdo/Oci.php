<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Mmi\Db\Adapter\Pdo;

class Oci extends PdoAbstract {

	/**
	 * Ustawia schemat
	 * @param string $schemaName nazwa schematu
	 * @return \Mmi\Db\Adapter\Pdo\Oci
	 */
	public function selectSchema($schemaName) {
		//oracle nie obsługuje schematów - bazy są selectowane po nazwie użytkownika; owner = schema
		$this->_config->schema = $schemaName;
		return $this;
	}

	/**
	 * Ustawia domyślne parametry dla importu (długie zapytania)
	 * @return \Mmi\Db\Adapter\Pdo\Oci
	 */
	public function setDefaultImportParams() {
		//dostępne parametry - query: SHOW PARAMETERS
		return $this;
	}

	/**
	 * Tworzy połączenie z bazą danych
	 */
	public function connect() {
		$this->_config->port = $this->_config->port ? $this->_config->port : 5432;
		$this->_config->charset = $this->_config->charset ? $this->_config->charset : 'utf8';
		if ($this->_config->profiler) {
			\Mmi\Db\Profiler::event('CONNECT WITH: ' . get_called_class(), 0);
		}
		$this->_pdo = new \PDO(
			$this->_config->driver . ':host=' . $this->_config->host . ';port=' . $this->_config->port . ';dbname=' . $this->_config->name . ';charset=' . $this->_config->charset, $this->_config->user, $this->_config->password, array(\PDO::ATTR_PERSISTENT => $this->_config->persistent)
		);
		$this->_connected = true;
		$this->_pdo->setAttribute(\PDO::ATTR_STRINGIFY_FETCHES, true);
		$this->query('ALTER SESSION SET NLS_TIMESTAMP_FORMAT = "YYYY-MM-DD HH24:MI:SS"');
		return $this;
	}

	/**
	 * Wydaje zapytanie \PDO prepare, execute
	 * rzuca wyjątki
	 * @see \PDO::prepare()
	 * @see \PDO::execute()
	 * @param string $sql zapytanie
	 * @param array $bind tabela w formacie akceptowanym przez \PDO::prepare()
	 * @throws \Mmi\Db\Exception
	 * @return \PDO_Statement
	 */
	public function query($sql, array $bind = array()) {
		if (!$this->_connected) {
			$this->connect();
		}
		$start = microtime(true);
		$statement = $this->_pdo->prepare($sql);
		if (!$statement) {
			$error = $this->_pdo->errorInfo();
			throw new \Mmi\Db\Exception(get_called_class() . ': ' . (isset($error[2]) ? $error[2] : $error[0]) . ' --- ' . $sql);
		}
		$values = array();
		foreach ($bind as $key => $param) {
			$type = \PDO::PARAM_STR;
			if (is_int($key)) {
				$key = $key + 1;
			}
			$values[$key] = array("value" => $param, "length" => strlen($param));
			if (is_bool($param)) {
				$type = \PDO::PARAM_BOOL;
				$statement->bindParam($key, $values[$key]["value"], $type);
			} else {
				$statement->bindParam($key, $values[$key]["value"], $type, $values[$key]["length"]);
			}
		}
		$result = $statement->execute();
		$statement->result = $result;
		if ($result != 1) {
			$error = $statement->errorInfo();
			$error = isset($error[2]) ? $error[2] : $error[0];
			throw new \Mmi\Db\Exception(get_called_class() . ': ' . $error . ' --- ' . $sql);
		}
		if ($this->_config->profiler) {
			\Mmi\Db\Profiler::eventQuery($statement, $bind, microtime(true) - $start);
		}
		return $statement;
	}

	/**
	 * Otacza nazwę pola odpowiednimi znacznikami
	 * @param string $fieldName nazwa pola
	 * @return string
	 */
	public function prepareField($fieldName) {
		//dla oracle "
		if (strpos($fieldName, '"') === false) {
			$fieldName = substr($fieldName, 0, 30); //maksymalna długość nazwy pola w oracle
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
		$initialSql = 'SELECT' .
			' ' . $fields .
			' FROM' .
			' ' . $this->prepareField($from) .
			' ' . $where .
			' ' . $order;

		$sql = $initialSql;

		if ($limit > 0) {
			$sql = 'SELECT * FROM (' . $initialSql . ') WHERE ROWNUM  <= ' . intval($limit);
		}

		if ($offset > 0) {
			$sql = 'SELECT * FROM (SELECT a.*, ROWNUM rnum FROM (' . $initialSql . ')' .
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
			WHERE "OWNER" = :schema
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
