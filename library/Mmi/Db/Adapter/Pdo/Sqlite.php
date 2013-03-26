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
 * Mmi/Db/Adapter/Pdo/Sqlite.php
 * @category   Mmi
 * @package    Mmi_Db
 * @subpackage Adapter
 * @copyright  Copyright (c) 2012 HQSoft Mariusz Miłejko (http://www.hqsoft.pl)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    $Id$
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */

/**
 * Klasa adaptera SQLite
 * @category   Mmi
 * @package    Mmi_Db
 * @subpackage Adapter
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */
class Mmi_Db_Adapter_Pdo_Sqlite extends Mmi_Db_Adapter_Pdo_Abstract {
	
	protected static $_orderFunctions = array(
		'RAND()' => 'RANDOM()'
	);

	public function selectSchema($schemaName) {
		
	}

	public function setDefaultImportParams() {

	}

	public function connect() {
		if (isset($this->_options['profiler']) && $this->_options['profiler']) {
			$this->_profiler = Mmi_Db_Profiler::getInstance();
		}
		if ($this->_profiler) {
			$this->_profiler->event('CONNECT WITH: ' . get_class($this), 0);
		}
		$this->_pdo = new PDO(
						$this->_options['driver'] . ':' . $this->_options['host'],
						null, null,
						array(PDO::ATTR_PERSISTENT => $this->_options['persistent'])
		);
		$this->_connected = true;
		$this->query('PRAGMA foreign_keys = ON');
	}

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

	public function prepareField($fieldName) {
		//dla sqlite "
		if (strpos($fieldName, '"') === false) {
			return '"' . $fieldName . '"';
		}
		return $fieldName;
	}

	public function prepareTable($tableName) {
		//dla sqlite jak pola
		return $this->prepareField($tableName);
	}

	public function tableInfo($tableName, $schema = null) {
		//schema nie jest używane w sqlite
		return $this->_associateTableMeta($this->fetchAll('PRAGMA table_info(' . $this->prepareTable($tableName) . ')'));
	}

	public function prepareNullCheck($fieldName, $positive = true) {
		if ($positive) {
			return '(' . $fieldName . ' is null OR ' . $fieldName . ' = ' . $this->quote('') . ')';
		}
		return $fieldName . ' is not null';
	}

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
