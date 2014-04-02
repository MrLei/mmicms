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
 * Mmi/Dao/Query.php
 * @category   Mmi
 * @package    Mmi_Dao
 * @copyright  Copyright (c) 2010 HQSoft Mariusz Miłejko (http://www.hqsoft.pl)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    $Id$
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */

/**
 * Klasa zapytania DAO
 * @category   Mmi
 * @package    Mmi_Dao
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */
class Mmi_Dao_Query {

	/**
	 * Kompilant zapytania
	 * @var Mmi_Dao_Query_Compile
	 */
	protected $_compile;

	/**
	 * Konstruktor tworzy nowe skompilowane zapytanie
	 */
	public function __construct() {
		$this->_compile = new Mmi_Dao_Query_Compile();
	}

	/**
	 * Ustawia limit
	 * @param int $limit
	 * @return Mmi_Dao_Query
	 */
	public function limit($limit = null) {
		$this->_compile->limit = $limit;
		return $this;
	}

	/**
	 * Ustawia ofset
	 * @param int $offset
	 * @return Mmi_Dao_Query
	 */
	public function offset($offset = null) {
		$this->_compile->offset = $offset;
		return $this;
	}

	/**
	 * Sortowanie rosnące
	 * @param string $fieldName nazwa pola
	 * @param string $tableName opcjonalna nazwa tabeli źródłowej
	 * @return Mmi_Dao_Query
	 */
	public function orderAsc($fieldName, $tableName = null) {
		$this->_compile->order[] = array($fieldName, 'ASC', $tableName);
		return $this;
	}

	/**
	 * Sortowanie malejące
	 * @param string $fieldName nazwa pola
	 * @param string $tableName opcjonalna nazwa tabeli źródłowej
	 * @return Mmi_Dao_Query
	 */
	public function orderDesc($fieldName, $tableName = null) {
		$this->_compile->order[] = array($fieldName, 'DESC', $tableName);
		return $this;
	}

	/**
	 * Dodaje podsekcję AND
	 * @param Mmi_Dao_Query $query
	 * @return Mmi_Dao_Query
	 */
	public function andQuery(Mmi_Dao_Query $query) {
		$bind = $query->queryCompilation()->bind;
		if (empty($bind)) {
			return $this;
		}
		$this->_compile->bind[] = array($bind, 'AND');
		return $this;
	}

	/**
	 * Dodaje podsekcję WHERE (jak AND)
	 * @param Mmi_Dao_Query $query
	 * @return Mmi_Dao_Query
	 */
	public function whereQuery(Mmi_Dao_Query $query) {
		return $this->andQuery($query);
	}

	/**
	 * Dodaje podsekcję OR
	 * @param Mmi_Dao_Query $query
	 * @return Mmi_Dao_Query
	 */
	public function orQuery(Mmi_Dao_Query $query) {
		$bind = $query->queryCompilation()->bind;
		if (empty($bind)) {
			return $this;
		}
		$this->_compile->bind[] = array($bind, 'OR');
		return $this;
	}

	/**
	 * Dodaje warunek na pole AND
	 * @param string $fieldName nazwa pola
	 * @param string $tableName opcjonalna nazwa tabeli źródłowej
	 * @return Mmi_Dao_Query_Field
	 */
	public function andField($fieldName, $tableName = null) {
		return new Mmi_Dao_Query_Field($this, $fieldName, $tableName, 'AND');
	}

	/**
	 * Pierwszy warunek w zapytaniu (domyślnie AND)
	 * @param string $fieldName nazwa pola
	 * @param string $tableName opcjonalna nazwa tabeli źródłowej
	 * @return Mmi_Dao_Query_Field
	 */
	public function where($fieldName, $tableName = null) {
		return $this->andField($fieldName, $tableName);
	}

	/**
	 * Dodaje warunek na pole OR
	 * @param string $fieldName nazwa pola
	 * @param string $tableName opcjonalna nazwa tabeli źródłowej
	 * @return Mmi_Dao_Query_Field
	 */
	public function orField($fieldName, $tableName = null) {
		return new Mmi_Dao_Query_Field($this, $fieldName, $tableName, 'OR');
	}

	/**
	 * Łączy tabelę
	 * @param string $tableName nazwa tabeli
	 * @param string $targetTableName opcjonalnie nazwa tabeli do której łączyć
	 * @return Mmi_Dao_Query_Join
	 */
	public function join($tableName, $targetTableName = null) {
		return new Mmi_Dao_Query_Join($this, $tableName, 'JOIN', $targetTableName);
	}

	/**
	 * Łączy tabelę złączeniem lewym
	 * @param string $tableName nazwa tabeli
	 * @param string $targetTableName opcjonalnie nazwa tabeli do której łączyć
	 * @return Mmi_Dao_Query_Join
	 */
	public function joinLeft($tableName, $targetTableName = null) {
		return new Mmi_Dao_Query_Join($this, $tableName, 'LEFT JOIN', $targetTableName);
	}

	/**
	 * Zwraca skompilowane zapytanie
	 * @return Mmi_Dao_Query_Compile
	 */
	public function queryCompilation() {
		return $this->_compile;
	}

	/**
	 * Zwraca skrót MD5 zapytania
	 * @return string
	 */
	public function queryCompilationMd5() {
		return md5(print_r($this->_compile, true));
	}

}
