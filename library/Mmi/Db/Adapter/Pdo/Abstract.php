<?php

/**
 * Mmi
 *
 * LICENSE
 *
 * Ten plik źródłowy objęty jest licencją BSD bez klauzuli ogłoszeniowej.
 * Licencja jest dostępna pod adresem: http://www.hqsoft.pl/new-bsd
 * W przypadku problemów, prosimy o kontakt na adres office@hqsoft.pl
 *
 * Mmi/Db/Adapter/Pdo/Abstact.php
 * @category   Mmi
 * @package    Mmi_Db
 * @subpackage Adapter
 * @copyright  Copyright (c) 2010 HQSoft Mariusz Miłejko (http://www.hqsoft.pl)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    $Id$
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */

/**
 * Abstrakcyjna klasa adapterów bazodanowych opartych o PDO
 * @category   Mmi
 * @package    Mmi_Db
 * @subpackage Adapter
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */
abstract class Mmi_Db_Adapter_Pdo_Abstract {

	/**
	 * Obiekt PDO
	 * @var PDO
	 */
	protected $_pdo;

	/**
	 * Profiler bazodanowy
	 * @var Mmi_Db_Profiler
	 */
	protected $_profiler;

	/**
	 * Opcje konfiguracyjne
	 * @var array
	 */
	protected $_options;

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
	 * Tworzy konstrukcję sprawdzającą null w silniku bazy danych
	 * @param string $fieldName nazwa pola
	 * @param boolean $positive sprawdza czy null, lub czy nie null
	 * @return string 
	 */
	abstract public function prepareNullCheck($fieldName, $positive = true);

	/**
	 * Ustawia schemat
	 * @param string $schemaName nazwa schematu
	 */
	abstract public function selectSchema($schemaName);

	/**
	 * Ustawia domyślne parametry dla importu (długie zapytania)
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
	 * @param array $options 
	 */
	public function __construct(array $options) {
		$options['persistent'] = (isset($options['persistent']) && $options['persistent']) ? true : false;
		$this->_options = $options;
		$this->_connected = false;
	}

	/**
	 * Magiczne wywołanie metod z PDO
	 * @param string $method nazwa metody
	 * @param array $params tablica z parametrami
	 * @return mixed
	 */
	public final function __call($method, $params) {
		if (!$this->_connected) {
			$this->connect();
		}
		return call_user_func_array(array($this->_pdo, $method), $params);
	}

	/**
	 * Tworzy połączenie z bazą danych
	 */
	public function connect() {
		if (isset($this->_options['profiler']) && $this->_options['profiler']) {
			$this->_profiler = Mmi_Db_Profiler::getInstance();
		}
		if ($this->_profiler) {
			$this->_profiler->event('CONNECT WITH: ' . get_class($this), 0);
		}
		$this->_pdo = new PDO(
						$this->_options['driver'] . ':host=' . $this->_options['host'] . ';port=' . $this->_options['port'] . ';dbname=' . $this->_options['dbname'], $this->_options['username'], $this->_options['password'],
						array(PDO::ATTR_PERSISTENT => $this->_options['persistent'])
		);
		$this->_connected = true;
	}

	/**
	 * Zwraca opakowaną cudzysłowami wartość
	 * @see PDO::quote()
	 * @see PDO::PARAM_STR
	 * @see PDO::PARAM_INT
	 * @param string $value wartość
	 * @param string $paramType 
	 * @return string
	 */
	public final function quote($value, $paramType = PDO::PARAM_STR) {
		if (!$this->_connected) {
			$this->connect();
		}
		switch (gettype($value)) {
			case 'NULL':
				return 'NULL';
				break;
			case 'integer':
				return intval($value);
				break;
			case 'boolean':
				return $value ? 'true' : 'false';
				break;
		}
		return $this->_pdo->quote($value, $paramType);
	}

	/**
	 * Wydaje zapytanie PDO prepare, execute
	 * rzuca wyjątki
	 * @see PDO::prepare()
	 * @see PDO::execute()
	 * @param string $sql zapytanie
	 * @param array $bind tabela w formacie akceptowanym przez PDO::prepare()
	 * @return PDO_Statement
	 */
	public final function query($sql, array $bind = array()) {
		if (!$this->_connected) {
			$this->connect();
		}
		$start = microtime(true);
		$statement = $this->_pdo->prepare($sql);
		if (!$statement) {
			$error = $this->_pdo->errorInfo();
			$error = isset($error[2]) ? $error[2] : $error[0];
			throw new Exception('DB exception: ' . $error . ' --- ' . $sql);
		}
		foreach ($bind as $key => $param) {
			$type = PDO::PARAM_STR;
			if (is_bool($param)) {
				$type = PDO::PARAM_BOOL;
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
			throw new Exception('DB exception: ' . $error . ' --- ' . $sql);
		}
		if ($this->_profiler) {
			$qs = $statement->queryString;
			if (!empty($bind)) {
				$qs .= "\n" . print_r($bind, true);
			}
			$this->_profiler->event($qs, microtime(true) - $start);
		}
		return $statement;
	}

	/**
	 * Zwraca ostatnio wstawione ID
	 * @param string $name opcjonalnie nazwa serii (ważne w PostgreSQL)
	 * @return mixed
	 */
	public final function lastInsertId($name = null) {
		return $this->_pdo->lastInsertId($name);
	}

	/**
	 * Zwraca wszystkie rekordy (rządki)
	 * @param string $sql zapytanie
	 * @param array $bind tabela w formacie akceptowanym przez PDO::prepare()
	 * @return array
	 */
	public final function fetchAll($sql, array $bind = array()) {
		return $this->query($sql, $bind)->fetchAll(PDO::FETCH_NAMED);
	}

	/**
	 * Zwraca pierwszy rekord (rządek)
	 * @param string $sql zapytanie
	 * @param array $bind tabela w formacie akceptowanym przez PDO::prepare()
	 * @return array
	 */
	public final function fetchRow($sql, array $bind = array()) {
		return $this->query($sql, $bind)->fetch(PDO::FETCH_NAMED);
	}

	/**
	 * Zwraca pojedynczą wartość (krotkę)
	 * @param string $sql zapytanie
	 * @param array $bind tabela w formacie akceptowanym przez PDO::prepare()
	 * @return array
	 */
	public final function fetchOne($sql, array $bind = array()) {
		return $this->query($sql, $bind)->fetch(PDO::FETCH_NUM);
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
			$i++;
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
	public function update($table, array $data = array(), array $whereBind = array()) {
		$fields = '';
		$bind = array();
		foreach ($data as $key => $value) {
			$fields .= $this->prepareField($key) . ' = ?, ';
			$bind[] = $value;
		}
		$where = $this->_parseWhereBind($whereBind, $table);
		$sql = 'UPDATE ' . $this->prepareTable($table) . ' SET ' . rtrim($fields, ', ') . $where['sql'];
		foreach ($where['bind'] as $rule) {
			$bind[] = $rule;
		}
		return $this->query($sql, $bind)->rowCount();
	}

	/**
	 * Kasowanie rekordu
	 * @param string $table nazwa tabeli
	 * @param array $whereBind warunek w postaci zagnieżdżonego bind
	 * @return integer
	 */
	public function delete($table, array $whereBind = array()) {
		$where = $this->_parseWhereBind($whereBind, $table);
		$sql = 'DELETE FROM ' . $this->prepareTable($table) . $where['sql'];
		return $this->query($sql, $where['bind'])->rowCount();
	}

	/**
	 * Pobieranie rekordów
	 * @param string $table nazwa tabeli
	 * @param array $whereBind warunek w postaci zagnieżdżonego bind
	 * @param array $orderBind sortowanie w postaci zagnieżdżonego bind
	 * @param int $limit limit
	 * @param int $offset ofset
	 * @param array $fields pola do wybrania
	 * @param array $joinSchema schemat połączeń
	 * @return array
	 */
	public function select($table, array $whereBind = array(), array $orderBind = array(), $limit = null, $offset = null, array $fields = array('*'), array $joinSchema = array()) {
		$selectFields = '';
		foreach ($fields as $field) {
			if ($field == '*' || (strpos($field, '(') !== false && strpos($field, ')'))) {
				$selectFields = $field;
				break;
			}
			$selectFields .= $this->prepareField($field) . ', ';
		}
		$where = $this->_parseWhereBind($whereBind, $table);
		$sql = 'SELECT ' . rtrim($selectFields, ', ') . ' FROM ' . $this->prepareTable($table);
		if (!empty($joinSchema)) {
			foreach ($joinSchema as $joinTable => $condition) {
				$targetTable = isset($condition[2]) ? $condition[2] : $table;
				$joinType = isset($condition[3]) ? $condition[3] : 'JOIN';
				$sql .= ' ' . $joinType . ' ' . $this->prepareTable($joinTable) . ' ON ' .
						$this->prepareTable($joinTable) . '.' . $condition[0] .
						' = ' . $this->prepareTable($targetTable) . '.' . $condition[1];
			}
		}
		$sql .= $where['sql'] . $this->_parseOrderBind($orderBind, $table) . $this->prepareLimit($limit, $offset);
		return $this->fetchAll($sql, $where['bind']);
	}

	/**
	 * Rozpoczyna transakcję
	 */
	public final function beginTransaction() {
		return $this->_pdo->beginTransaction();
	}

	/**
	 * Zatwierdza transakcję
	 */
	public final function commit() {
		return $this->_pdo->commit();
	}

	/**
	 * Odrzuca transakcję
	 */
	public final function rollBack() {
		return $this->_pdo->rollBack();
	}

	/**
	 * Pobiera profiler
	 */
	public final function getProfiler() {
		return $this->_profiler;
	}

	/**
	 * Zwraca obiekt PDO
	 * @return PDO
	 */
	public final function getPdo() {
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
			return ' LIMIT ' . intval($offset) . ', ' . intval($limit);
		}
		return ' LIMIT ' . intval($limit);
	}

	/**
	 * Parsuje bind i tworzy ORDER
	 * @param array $bind tabela w postaci: pole, ASC lub DESC
	 * @param string $table nazwa tabeli
	 * @return string ciąg SQL
	 */
	protected function _parseOrderBind(array $bind = array(), $table = null) {
		$order = '';
		if (isset($bind[0]) && !is_array($bind[0])) {
			$bind = array($bind);
		}
		foreach ($bind as $rule) {
			if (!isset($rule[0])) {
				throw new Exception('Invalid order, missing name');
			}
			$orderTable = isset($rule[2]) ? $rule[2] : $table;
			if ($orderTable !== null) {
				$orderTable = $this->prepareTable($orderTable) . '.';
			}
			
			if (isset(static::$_orderFunctions[$rule[0]])) {
				$order .= static::$_orderFunctions[$rule[0]];
			} else {
				switch (isset($rule[1]) ? $rule[1] : 'ASC') {
					case 'DESC':
						$order .= ', ' . $orderTable . $this->prepareField($rule[0]) . ' DESC';
						break;
					case 'ASC':
					default:
						$order .= ', ' . $orderTable . $this->prepareField($rule[0]) . ' ASC';
				}
			}
		}
		$order = trim($order, ', ');
		return $order ? ' ORDER BY ' . $order : '';
	}

	/**
	 * Parsuje bind i tworzy warunek WHERE
	 * @param array $bind tabela w postaci: pole, wartość, relacja ('=','<','>','>=','<=', 'LIKE', 'IN'), typ relacji (AND|OR)
	 * domyślna relacja: =, domyśny typ relacji: AND
	 * @param string $table nazwa tabeli
	 * @return array array('sql' => ..., 'bind' => array)
	 */
	protected function _parseWhereBind(array $bind = array(), $table = null) {
		$params = array();
		$where = $this->_parseWhereBindRecursive($bind, $params, $table);
		return array(
			'sql' => ($where ? ' WHERE ' . $where : ''),
			'bind' => $params
		);
	}

	/**
	 * Tworzy rekursywnie warunek WHERE na podstawie zagnieżdżonego bind'a
	 * @param array $bind tabela w postaci: pole, wartość, relacja ('=','<','>','>=','<=', 'LIKE', 'IN'), typ relacji (AND|OR)
	 * @param array $params referencja do budowanego bind'a z wartościami
	 * @param string $table nazwa tabeli
	 * @return string ciąg SQL
	 */
	protected function _parseWhereBindRecursive(array $bind, array &$params = array(), $table = null) {
		$where = '';
		if (isset($bind[0]) && is_string($bind[0])) {
			$where .= $this->_parseWhereBindLevel($bind, $params, $table);
		} else {
			foreach ($bind as $rule) {
				if (isset($rule[0]) && is_string($rule[0])) {
					$where .= $this->_parseWhereBindLevel($rule, $params, $table);
				} elseif (!empty($rule)) {
					$glue = 'AND';
					$count = count($rule);
					if ($count > 0 && is_string($rule[$count - 1])) {
						$glue = $rule[$count - 1];
						array_pop($rule);
					}
					$where .= ' ' . $glue . ' (';
					$where .= $this->_parseWhereBindRecursive($rule, $params, $table);
					$where .= ')';
				}
			}
		}
		return trim($where, 'ANDOR ');
	}

	/**
	 * Analizuje i zwraca wynik parsowania jednego poziomu bind
	 * @param array $rule reguła np. array(array('id', 2), array(user, 3))
	 * @param array $params referencja do budowanego bind'a z wartościami
	 * @param string $table nazwa tabeli
	 * @return string ciąg SQL
	 */
	protected function _parseWhereBindLevel(array $rule, array &$params = array(), $table = null) {
		$where = '';
		$table = isset($rule[4]) ? $rule[4] : $table;
		if ($table !== null) {
			$table = $this->prepareTable($table) . '.';
		}
		if (!isset($rule[3]) || $rule[3] != 'OR') {
			$rule[3] = 'AND';
		}

		$rule[2] = isset($rule[2]) ? $rule[2] : '=';

		if ($rule[2] == '!=') {
			$rule[2] = '<>';
		}
		if (array_key_exists('1', $rule)) {
			if (isset($rule[1])) {
				$where .= ' ' . $rule[3];
				$where .= ' ' . $table . $this->prepareField($rule[0]);
				$where .= ' ' . $rule[2];
				if ($rule[2] == 'IN' || $rule[2] == 'NOT IN') {
					$args = explode(',', $rule[1]);
					$where .= ' (';
					foreach ($args as $arg) {
						$where .= '?, ';
						$params[] = $arg;
					}
					$where = rtrim($where, ', ') . ')';
				} else {
					$where .= ' ?';
					$params[] = $rule[1];
				}
			} else {
				if (isset($rule[2]) && $rule[2] == '<>') {
					$where .= ' ' . $rule[3] . ' ' . $this->prepareNullCheck($table . $this->prepareField($rule[0]), false) . ' ';
				} else {
					$where .= ' ' . $rule[3] . ' ' . $this->prepareNullCheck($table . $this->prepareField($rule[0])) . ' ';
				}
			}
		}
		return $where;
	}

	/**
	 * Konwertuje do tabeli asocjacyjnej meta dane tabel
	 * @param array $meta meta data
	 * @return array
	 */
	protected function _associateTableMeta($meta) {
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

}
