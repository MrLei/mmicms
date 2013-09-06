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
 * Mmi/Db/Adapter/Pdo/Mysql.php
 * @category   Mmi
 * @package    Mmi_Db
 * @subpackage Adapter
 * @copyright  Copyright (c) 2010 HQSoft Mariusz Miłejko (http://www.hqsoft.pl)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    $Id$
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */

/**
 * Klasa adaptera MySQL
 * @category   Mmi
 * @package    Mmi_Db
 * @subpackage Adapter
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
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
		$this->_options['host'] = isset($this->_options['host']) ? $this->_options['host'] : '127.0.0.1';
		$this->_options['port'] = isset($this->_options['port']) ? $this->_options['port'] : '3306';
		parent::connect();
		$this->query('SET NAMES ' . $this->_options['charset']);
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
	 * @param array $schema schemat
	 * @return array
	 */
	public function tableInfo($tableName, $schema = null) {
		return $this->_associateTableMeta($this->fetchAll('SELECT `column_name` as `name`, `data_type` AS `dataType`, `character_maximum_length` AS `maxLength`, `is_nullable` AS `null`, `column_default` AS `default`, `extra` AS `extra`, `column_key` AS `column_key` FROM INFORMATION_SCHEMA.COLUMNS WHERE `table_name` = :name AND `table_schema` = :schema ORDER BY `ordinal_position`', array(
			':name' => $tableName,
			':schema' => ($schema) ? $schema : $this->_options['dbname']
		)));
	}

	/**
	 * Tworzy konstrukcję sprawdzającą null w silniku bazy danych
	 * @param string $fieldName nazwa pola
	 * @param boolean $positive sprawdza czy null, lub czy nie null
	 * @return string 
	 */
	public function prepareNullCheck($fieldName, $positive = true) {
		$positive = $positive ? '' : '!';
		return $positive . 'ISNULL(' . $fieldName . ')';
	}

}
