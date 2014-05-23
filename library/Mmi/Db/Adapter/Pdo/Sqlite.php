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
 * Mmi/Db/Adapter/Pdo/Sqlite.php
 * @category   Mmi
 * @package    Mmi_Db
 * @subpackage Adapter
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    1.0.0
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

/**
 * Klasa adaptera SQLite
 * @category   Mmi
 * @package    Mmi_Db
 * @subpackage Adapter
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */
class Mmi_Db_Adapter_Pdo_Sqlite extends Mmi_Db_Adapter_Pdo_Abstract {

	/**
	 * Przechowuje funkcje sortowania
	 * @var array
	 */
	protected static $_orderFunctions = array(
		'RAND()' => 'RANDOM()'
	);

	/**
	 * Ustawia schemat
	 * @param string $schemaName nazwa schematu
	 */
	public function selectSchema($schemaName) {

	}

	/**
	 * Ustawia domyślne parametry dla importu (długie zapytania)
	 */
	public function setDefaultImportParams() {

	}

	/**
	 * Tworzy połączenie z bazą danych
	 */
	public function connect() {
		if ($this->_config->profiler) {
			Mmi_Db_Profiler::event('CONNECT WITH: ' . get_class($this), 0);
		}
		$this->_pdo = new PDO(
						$this->_config->driver . ':' . $this->_config->host,
						null, null,
						array(PDO::ATTR_PERSISTENT => $this->_config->persistent)
		);
		$this->_connected = true;
		$this->query('PRAGMA foreign_keys = ON');
	}

	/**
	 * Wstawianie wielu rekordów
	 * @param string $table nazwa tabeli
	 * @param array $data tabela tabel w postaci: klucz => wartość
	 * @return integer
	 */
	public function insertAll($table, array $data = array()) {
		//brak natywnego wsparcia sqlite, wiele insertów dokonuje się uniami selectów
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
			if (!$fieldsCompleted) {
				$values .= ' SELECT ' . rtrim($cur, ', ') . "\n";
			} else {
				$values .= ' UNION SELECT ' . rtrim($cur, ', ') . "\n";
			}
			$fieldsCompleted = true;
		}
		$sql = 'INSERT INTO ' . $this->prepareTable($table) . ' (' . rtrim($fields, ', ') . ') ' . $values;
		return $this->query($sql, $bind)->rowCount();
	}

	/**
	 * Otacza nazwę pola odpowiednimi znacznikami
	 * @param string $fieldName nazwa pola
	 * @return string
	 */
	public function prepareField($fieldName) {
		//dla sqlite "
		if (strpos($fieldName, '"') === false) {
			return '"' . $fieldName . '"';
		}
		return $fieldName;
	}

	/**
	 * Otacza nazwę tabeli odpowiednimi znacznikami
	 * @param string $tableName nazwa tabeli
	 * @return string
	 */
	public function prepareTable($tableName) {
		//dla sqlite jak pola
		return $this->prepareField($tableName);
	}

	/**
	 * Zwraca informację o kolumnach tabeli
	 * @param string $tableName nazwa tabeli
	 * @param array $schema schemat
	 * @return array
	 */
	public function tableInfo($tableName, $schema = null) {
		//schema nie jest używane w sqlite
		return $this->_associateTableMeta($this->fetchAll('PRAGMA table_info(' . $this->prepareTable($tableName) . ')'));
	}

	/**
	 * Tworzy konstrukcję sprawdzającą null w silniku bazy danych
	 * @param string $fieldName nazwa pola
	 * @param boolean $positive sprawdza czy null, lub czy nie null
	 * @return string
	 */
	public function prepareNullCheck($fieldName, $positive = true) {
		if ($positive) {
			return '(' . $fieldName . ' is null OR ' . $fieldName . ' = ' . $this->quote('') . ')';
		}
		return $fieldName . ' is not null';
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
				'dataType' => $column['type'],
				'maxLength' => null,
				'null' => ($column['notnull'] == 1) ? false : true,
				'default' => $column['dflt_value']
			);
		}
		return $associativeMeta;
	}

}
