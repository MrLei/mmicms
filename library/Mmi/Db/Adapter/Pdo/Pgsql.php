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
 * Mmi/Db/Adapter/Pdo/Pgsql.php
 * @category   Mmi
 * @package    Mmi_Db
 * @subpackage Adapter
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    1.0.0
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

/**
 * Klasa adaptera PostgreSQL
 * @category   Mmi
 * @package    Mmi_Db
 * @subpackage Adapter
 * @license    http://milejko.com/new-bsd.txt     New BSD License
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
		$tableInfo = $this->fetchAll('SELECT "column_name" as "name", "data_type" AS "dataType", "character_maximum_length" AS "maxLength", "is_nullable" AS "null", "column_default" AS "default" FROM INFORMATION_SCHEMA.COLUMNS WHERE "table_name" = :name AND "table_schema" = :schema ORDER BY "ordinal_position"', array(
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
		$list = $this->fetchAll('SELECT table_name as name
			FROM information_schema.tables
			WHERE table_schema = :schema
			ORDER BY table_name', array(':schema' => ($schema) ? $schema : ($this->_config->schema ? $this->_config->schema : $this->_config->name)));
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
		return 'CAST(' . $fieldName . ') AS text ILIKE';
	}

}
