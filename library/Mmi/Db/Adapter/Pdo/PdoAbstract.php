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
 * Mmi/Db/Adapter/Pdo/PdoAbstact.php
 * @category   Mmi
 * @package    \Mmi\Db
 * @subpackage Adapter
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    1.0.0
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */
/**
 * Abstrakcyjna klasa adapterów bazodanowych opartych o \PDO
 * @category   Mmi
 * @package    \Mmi\Db
 * @subpackage Adapter
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

namespace Mmi\Db\Adapter\Pdo;

abstract class PdoAbstract {

	/**
	 * Obiekt \PDO
	 * @var \PDO
	 */
	protected $_pdo;

	/**
	 * Konfiguracja
	 * @var \Mmi\Db\Config
	 */
	protected $_config;

	/**
	 * Przechowuje funkcje sortowania
	 * @var array
	 */
	protected static $_orderFunctions = array(
		'RAND()' => 'RAND()'
	);

	/**
	 * Stan połączenia
	 * @var boolean
	 */
	protected $_connected;

	/**
	 * Otacza nazwę pola odpowiednimi znacznikami
	 * @param string $fieldName nazwa pola
	 * @return string
	 */
	abstract public function prepareField($fieldName);

	/**
	 * Otacza nazwę tabeli odpowiednimi znacznikami
	 * @param string $tableName nazwa tabeli
	 * @return string
	 */
	abstract public function prepareTable($tableName);

	/**
	 * Zwraca informację o kolumnach tabeli
	 * @param string $tableName nazwa tabeli
	 * @param array $schema schemat
	 * @return array
	 */
	abstract public function tableInfo($tableName, $schema = null);

	/**
	 * Listuje tabele w schemacie bazy danych
	 * @param string $schema
	 * @return array
	 */
	abstract public function tableList($schema = null);

	/**
	 * Tworzy konstrukcję sprawdzającą null w silniku bazy danych
	 * @param string $fieldName nazwa pola
	 * @param boolean $positive sprawdza czy null, lub czy nie null
	 * @return string
	 */
	abstract public function prepareNullCheck($fieldName, $positive = true);

	/**
	 * Tworzy konstrukcję sprawdzającą ILIKE, jeśli dostępna w silniku
	 * @param string $fieldName nazwa pola
	 * @return string
	 */
	abstract public function prepareIlike($fieldName);

	/**
	 * Ustawia schemat
	 * @param string $schemaName nazwa schematu
	 * @return \Mmi\Db\Adapter\Pdo\Abstract
	 */
	abstract public function selectSchema($schemaName);

	/**
	 * Ustawia domyślne parametry dla importu (długie zapytania)
	 * @return \Mmi\Db\Adapter\Pdo\Abstract
	 */
	abstract public function setDefaultImportParams();

	/**
	 * Zwraca nazwę sekwencji dla tabeli
	 * @param string $tableName nazwa tabeli
	 * @return string
	 */
	public function prepareSequenceName($tableName) {
		return $tableName . '_id_seq';
	}

	/**
	 * Konstruktor wczytujący konfigurację
	 * @param \Mmi\Db\Config $config
	 */
	public function __construct(\Mmi\Db\Config $config) {
		$this->_config = $config;
		$this->_connected = false;
	}

	/**
	 * Zwraca konfigurację
	 * @return \Mmi\Db\Config
	 */
	public final function getConfig() {
		return $this->_config;
	}

	/**
	 * Nieistniejące metody
	 * @param string $method
	 * @param array $params
	 * @throws \Mmi\Db\Exception
	 */
	public final function __call($method, $params) {
		throw new \Mmi\Db\Exception(get_called_class() . ': method not found: ' . $method);
	}

	/**
	 * Tworzy połączenie z bazą danych
	 * @return \Mmi\Db\Adapter\Pdo\Abstract
	 */
	public function connect() {
		if ($this->_config->profiler) {
			\Mmi\Db\Profiler::event('CONNECT WITH: ' . get_called_class(), 0);
		}
		$this->_pdo = new \PDO(
			$this->_config->driver . ':host=' . $this->_config->host . ';port=' . $this->_config->port . ';dbname=' . $this->_config->name, $this->_config->user, $this->_config->password, array(\PDO::ATTR_PERSISTENT => $this->_config->persistent)
		);
		$this->_connected = true;
		return $this;
	}

	/**
	 * Zwraca opakowaną cudzysłowami wartość
	 * @see \PDO::quote()
	 * @see \PDO::PARAM_STR
	 * @see \PDO::PARAM_INT
	 * @param string $value wartość
	 * @param string $paramType
	 * @return string
	 */
	public final function quote($value, $paramType = \PDO::PARAM_STR) {
		if (!$this->_connected) {
			$this->connect();
		}
		switch (gettype($value)) {
			case 'NULL':
				return 'NULL';
			case 'integer':
				return intval($value);
			case 'boolean':
				return $value ? 'true' : 'false';
		}
		return $this->_pdo->quote($value, $paramType);
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
		foreach ($bind as $key => $param) {
			$type = \PDO::PARAM_STR;
			if (is_bool($param)) {
				$type = \PDO::PARAM_BOOL;
			}
			if (is_int($key)) {
				$key = $key + 1;
			}
			$statement->bindValue($key, $param, $type);
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
	 * Zwraca ostatnio wstawione ID
	 * @param string $name opcjonalnie nazwa serii (ważne w PostgreSQL)
	 * @return mixed
	 */
	public function lastInsertId($name = null) {
		if (!$this->_connected) {
			$this->connect();
		}
		return $this->_pdo->lastInsertId($name);
	}

	/**
	 * Zwraca wszystkie rekordy (rządki)
	 * @param string $sql zapytanie
	 * @param array $bind tabela w formacie akceptowanym przez \PDO::prepare()
	 * @return array
	 */
	public final function fetchAll($sql, array $bind = array()) {
		return $this->query($sql, $bind)->fetchAll(\PDO::FETCH_NAMED);
	}

	/**
	 * Zwraca pierwszy rekord (rządek)
	 * @param string $sql zapytanie
	 * @param array $bind tabela w formacie akceptowanym przez \PDO::prepare()
	 * @return array
	 */
	public final function fetchRow($sql, array $bind = array()) {
		return $this->query($sql, $bind)->fetch(\PDO::FETCH_NAMED);
	}

	/**
	 * Zwraca pojedynczą wartość (krotkę)
	 * @param string $sql zapytanie
	 * @param array $bind tabela w formacie akceptowanym przez \PDO::prepare()
	 * @return array
	 */
	public final function fetchOne($sql, array $bind = array()) {
		return $this->query($sql, $bind)->fetch(\PDO::FETCH_NUM);
	}

	/**
	 * Wstawianie rekordu
	 * @param string $table nazwa tabeli
	 * @param array $data tabela w postaci: klucz => wartość
	 */
	public function insert($table, array $data = array()) {
		$fields = '';
		$values = '';
		$bind = array();
		foreach ($data as $key => $value) {
			$fields .= $this->prepareField($key) . ', ';
			$values .= '?, ';
			$bind[] = $value;
		}
		$sql = 'INSERT INTO ' . $this->prepareTable($table) . ' (' . rtrim($fields, ', ') . ') VALUES(' . rtrim($values, ', ') . ')';
		return $this->query($sql, $bind)->rowCount();
	}

	/**
	 * Wstawianie wielu rekordów
	 * @param string $table nazwa tabeli
	 * @param array $data tabela tabel w postaci: klucz => wartość
	 * @return integer
	 */
	public function insertAll($table, array $data = array()) {
		$fields = '';
		$fieldsCompleted = false;
		$values = '';
		$bind = array();
		foreach ($data as $row) {
			if (empty($row)) {
				continue;
			}
			$cur = '';
			foreach ($row as $key => $value) {
				if (!$fieldsCompleted) {
					$fields .= $this->prepareField($key) . ', ';
				}
				$cur .= '?, ';
				$bind[] = $value;
			}
			$values .= '(' . rtrim($cur, ', ') . '), ';
			$fieldsCompleted = true;
		}
		$sql = 'INSERT INTO ' . $this->prepareTable($table) . ' (' . rtrim($fields, ', ') . ') VALUES ' . rtrim($values, ', ');
		return $this->query($sql, $bind)->rowCount();
	}

	/**
	 * Aktualizacja rekordów
	 * @param string $table nazwa tabeli
	 * @param array $data tabela w postaci: klucz => wartość
	 * @param array $whereBind warunek w postaci zagnieżdżonego bind
	 * @return integer
	 */
	public function update($table, array $data = array(), $where = '', array $whereBind = array()) {
		$fields = '';
		$bind = array();
		if (empty($data)) {
			return 1;
		}
		foreach ($data as $key => $value) {
			$bindKey = self::generateRandomBindKey();
			$fields .= $this->prepareField($key) . ' = :' . $bindKey . ', ';
			$bind[$bindKey] = $value;
		}
		$sql = 'UPDATE ' . $this->prepareTable($table) . ' SET ' . rtrim($fields, ', ') . ' ' . $where;
		return $this->query($sql, array_merge($bind, $whereBind))->rowCount();
	}

	/**
	 * Kasowanie rekordu
	 * @param string $table nazwa tabeli
	 * @param array $whereBind warunek w postaci zagnieżdżonego bind
	 * @return integer
	 */
	public function delete($table, $where = '', array $whereBind = array()) {
		return $this->query('DELETE FROM ' . $this->prepareTable($table) . ' ' . $where, $whereBind)
				->rowCount();
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
			' ' . $order .
			' ' . $this->prepareLimit($limit, $offset);
		return $this->fetchAll($sql, $whereBind);
	}

	/**
	 * Rozpoczyna transakcję
	 */
	public final function beginTransaction() {
		if (!$this->_connected) {
			$this->connect();
		}
		return $this->_pdo->beginTransaction();
	}

	/**
	 * Zatwierdza transakcję
	 */
	public final function commit() {
		if (!$this->_connected) {
			$this->connect();
		}
		return $this->_pdo->commit();
	}

	/**
	 * Odrzuca transakcję
	 */
	public final function rollBack() {
		if (!$this->_connected) {
			$this->connect();
		}
		return $this->_pdo->rollBack();
	}

	/**
	 * Pobiera profiler
	 */
	public final function getProfiler() {
		return $this->_profiler;
	}

	/**
	 * Zwraca obiekt \PDO
	 * @return \PDO
	 */
	public final function getPdo() {
		if (!$this->_connected) {
			$this->connect();
		}
		return $this->_pdo;
	}

	/**
	 * Tworzy warunek limit
	 * @param int $limit
	 * @param int $offset
	 * @return string
	 */
	public function prepareLimit($limit = null, $offset = null) {
		if (!($limit > 0)) {
			return;
		}
		if ($offset > 0) {
			return 'LIMIT ' . intval($offset) . ', ' . intval($limit);
		}
		return 'LIMIT ' . intval($limit);
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
				'null' => ($column['null'] == 'YES') ? true : false,
				'default' => $column['default']
			);
		}
		return $associativeMeta;
	}

	/**
	 * Zwraca losowy klucz do binda
	 * @return string
	 */
	public static function generateRandomBindKey() {
		return str_replace(array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9), array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j'), mt_rand(100000, 999999));
	}

}
