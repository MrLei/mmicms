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
 * Mmi/Db/Adapter/Pdo/Pgsql.php
 * @category   Mmi
 * @package    Mmi_Db
 * @subpackage Adapter
 * @copyright  Copyright (c) 2012 HQSoft Mariusz Miłejko (http://www.hqsoft.pl)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    $Id$
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */

/**
 * Klasa adaptera PostgreSQL
 * @category   Mmi
 * @package    Mmi_Db
 * @subpackage Adapter
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */
class Mmi_Db_Adapter_Pdo_Pgsql extends Mmi_Db_Adapter_Pdo_Abstract {
	
	public function selectSchema($schemaName) {
		$this->query('SET search_path TO "' . $schemaName . '"');
	}
	
	public function setDefaultImportParams() {
		return $this->exec('SET statement_timeout = 0;
			SET client_encoding = \'UTF8\';
			SET standard_conforming_strings = on;
			SET check_function_bodies = false;
			SET client_min_messages = warning;
			SET default_with_oids = false;
			SET default_tablespace = \'\';
		');
	}

	public function connect() {
		$this->_options['host'] = isset($this->_options['host']) ? $this->_options['host'] : '127.0.0.1';
		$this->_options['port'] = isset($this->_options['port']) ? $this->_options['port'] : '5432';
		parent::connect();
		if (isset($this->_options['schema'])) {
			$this->query('SET search_path TO "' . $this->_options['schema'] . '"');
		}
		$this->query('SET client_encoding = ' . $this->_options['charset']);
	}

	public function prepareField($fieldName) {
		//dla postgresql "
		if (strpos($fieldName, '"') === false) {
			return '"' . $fieldName . '"';
		}
		return $fieldName;
	}

	public function prepareTable($tableName) {
		//dla postgresql "
		return $this->prepareField($tableName);
	}

	public function prepareLimit($limit = null, $offset = null) {
		if (!($limit > 0)) {
			return;
		}
		if ($offset > 0) {
			return ' LIMIT ' . intval($limit) . ' OFFSET ' . intval($offset);
		}
		return ' LIMIT ' . intval($limit);
	}

	public function prepareNullCheck($fieldName, $positive = true) {
		if ($positive) {
			return $fieldName . ' ISNULL';
		}
		return $fieldName . ' NOTNULL';
	}

	public function tableInfo($tableName, $schema = null) {
		return $this->_associateTableMeta($this->fetchAll('SELECT "column_name" as "name", "data_type" AS "dataType", "character_maximum_length" AS "maxLength", "is_nullable" AS "null", "column_default" AS "default" FROM INFORMATION_SCHEMA.COLUMNS WHERE "table_name" = :name AND "table_schema" = :schema ORDER BY "ordinal_position"', array(
			':name' => $tableName,
			':schema' => ($schema) ? $schema : (isset($this->_options['schema']) ? $this->_options['schema'] : $this->_options['dbname'])
		)));
	}

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
				if ($rule[2] == 'LIKE') {
					$rule[2] = 'ILIKE';
				}
				if ($rule[2] == 'ILIKE') {
					$where .= ' CAST(' . $table . $this->prepareField($rule[0]) . ' AS text)';
				} else {
					$where .= ' ' . $table . $this->prepareField($rule[0]);
				}
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

}
