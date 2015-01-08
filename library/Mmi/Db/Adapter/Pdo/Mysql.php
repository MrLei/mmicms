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
 * Mmi/Db/Adapter/Pdo/Mysql.php
 * @category   Mmi
 * @package    Mmi_Db
 * @subpackage Adapter
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    1.0.0
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

/**
 * Klasa adaptera MySQL
 * @category   Mmi
 * @package    Mmi_Db
 * @subpackage Adapter
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */
class Mmi_Db_Adapter_Pdo_Mysql extends Mmi_Db_Adapter_Pdo_Abstract {
	
	/**
	 * Ustawia schemat
	 * @param string $schemaName nazwa schematu
	 */
	public function selectSchema($schemaName) {
		$this->query('USE `' . $schemaName . '`');
	}

	/**
	 * Ustawia domyślne parametry dla importu (długie zapytania)
	 */
	public function setDefaultImportParams() {
		return $this->exec('SET NAMES utf8;
			SET foreign_key_checks = 0;
			SET time_zone = \'SYSTEM\';
			SET sql_mode = \'NO_AUTO_VALUE_ON_ZERO\';
		');
	}

	/**
	 * Tworzy połączenie z bazą danych
	 */
	public function connect() {
		$this->_config->port = $this->_config->port ? $this->_config->port : 3306;
		parent::connect();
		$this->query('SET NAMES ' . $this->_config->charset);
	}

	/**
	 * Otacza nazwę pola odpowiednimi znacznikami
	 * @param string $fieldName nazwa pola
	 * @return string
	 */
	public function prepareField($fieldName) {
		//dla mysql `
		if (strpos($fieldName, '`') === false) {
			return '`' . $fieldName . '`';
		}
		return $fieldName;
	}

	/**
	 * Otacza nazwę tabeli odpowiednimi znacznikami
	 * @param string $tableName nazwa tabeli
	 * @return string
	 */
	public function prepareTable($tableName) {
		//dla mysql tak jak pola
		return $this->prepareField($tableName);
	}

	/**
	 * Zwraca informację o kolumnach tabeli
	 * @param string $tableName nazwa tabeli
	 * @param array $schema schemat nie istotny w MySQL
	 * @return array
	 */
	public function tableInfo($tableName, $schema = null) {
		return $this->_associateTableMeta($this->fetchAll('SELECT `column_name` as `name`, `data_type` AS `dataType`, `character_maximum_length` AS `maxLength`, `is_nullable` AS `null`, `column_default` AS `default`, `extra` AS `extra`, `column_key` AS `column_key` FROM INFORMATION_SCHEMA.COLUMNS WHERE `table_name` = :name AND `table_schema` = :schema ORDER BY `ordinal_position`', array(
			':name' => $tableName,
			':schema' => ($schema) ? $schema : $this->_config->name
		)));
	}
	
	/**
	 * Listuje tabele w schemacie bazy danych
	 * @param string $schema nie istotny w MySQL
	 * @return array
	 */
	public function tableList($schema = null) {
		$list = $this->fetchAll('SHOW TABLES;');
		$tables = array();
		foreach ($list as $row) {
			foreach ($row as $name) {
				$tables[] = $name;
			}
		}
		return $tables;
	}

	/**
	 * Tworzy konstrukcję sprawdzającą null w silniku bazy danych
	 * @param string $fieldName nazwa pola
	 * @param boolean $positive sprawdza czy null, lub czy nie null
	 * @return string 
	 */
	public function prepareNullCheck($fieldName, $positive = true) {
		return ($positive ? '' : '!') . 'ISNULL(' . $fieldName . ')';
	}

	/**
	 * Tworzy konstrukcję sprawdzającą ILIKE, jeśli dostępna w silniku
	 * @param string $fieldName nazwa pola
	 * @return string
	 */
	public function prepareIlike($fieldName) {
		return $fieldName . ' LIKE';
	}

}
