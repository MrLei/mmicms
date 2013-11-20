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

	/**
	 * Ustawia schemat
	 * @param string $schemaName nazwa schematu
	 */
	public function selectSchema($schemaName) {
		$this->_config->schema = $schemaName;
		$this->query('SET search_path TO "' . $schemaName . '"');
	}

	/**
	 * Ustawia domyślne parametry dla importu (długie zapytania)
	 */
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
		$this->query('SET client_encoding = ' . $this->_config->charset);
	}

	/**
	 * Otacza nazwę pola odpowiednimi znacznikami
	 * @param string $fieldName nazwa pola
	 * @return string
	 */
	public function prepareField($fieldName) {
		//dla postgresql "
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
		//dla postgresql "
		return $this->prepareField($tableName);
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
			return ' LIMIT ' . intval($limit) . ' OFFSET ' . intval($offset);
		}
		return ' LIMIT ' . intval($limit);
	}

	/**
	 * Tworzy konstrukcję sprawdzającą null w silniku bazy danych
	 * @param string $fieldName nazwa pola
	 * @param boolean $positive sprawdza czy null, lub czy nie null
	 * @return string
	 */
	public function prepareNullCheck($fieldName, $positive = true) {
		if ($positive) {
			return $fieldName . ' ISNULL';
		}
		return $fieldName . ' NOTNULL';
	}

	/**
	 * Zwraca informację o kolumnach tabeli
	 * @param string $tableName nazwa tabeli
	 * @param array $schema schemat
	 * @return array
	 */
	public function tableInfo($tableName, $schema = null) {
		return $this->_associateTableMeta($this->fetchAll('SELECT "column_name" as "name", "data_type" AS "dataType", "character_maximum_length" AS "maxLength", "is_nullable" AS "null", "column_default" AS "default" FROM INFORMATION_SCHEMA.COLUMNS WHERE "table_name" = :name AND "table_schema" = :schema ORDER BY "ordinal_position"', array(
			':name' => $tableName,
			':schema' => ($schema) ? $schema : ($this->_config->schema ? $this->_config->schema : $this->_config->name)
		)));
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
		if (!array_key_exists('1', $rule)) {
			return $where;
		}
		if ($rule[1] === null) {
			$negation = !(isset($rule[2]) && $rule[2] == '<>');
			return ' ' . $rule[3] . ' ' . $this->prepareNullCheck($table . $this->prepareField($rule[0]), $negation) . ' ';
		}
		$where .= ' ' . $rule[3];

		if ($rule[2] == 'LIKE') {
			$rule[2] = 'ILIKE';
		}
		if ($rule[2] == 'ILIKE') {
			$where .= ' CAST(' . $table . $this->prepareField($rule[0]) . ' AS text)';
		} else {
			$where .= ' ' . $table . $this->prepareField($rule[0]);
		}

		if (is_array($rule[1])) {
			if ($rule[2] == '<>') {
				$rule[2] = 'NOT IN';
			} else {
				$rule[2] = 'IN';
			}
			$where .= ' ' . $rule[2] . ' (';
			foreach ($rule[1] as $arg) {
				$where .= '?, ';
				$params[] = $arg;
			}
			$where = rtrim($where, ' ),');
			$where .= ')';
			return $where;
		}

		$where .= ' ' . $rule[2] . ' ?';
		$params[] = $rule[1];
		return $where;
	}

}
