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
 * Mmi/Dao/Query/Field.php
 * @category   Mmi
 * @package    Mmi_Dao
 * @copyright  Copyright (c) 2010 HQSoft Mariusz Miłejko (http://www.hqsoft.pl)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    $Id$
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */

/**
 * Klasa pola w zapytaniu
 * @category   Mmi
 * @package    Mmi_Dao
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */
class Mmi_Dao_Query_Field {

	/**
	 * Nazwa pola
	 * @var string
	 */
	protected $_fieldName;
	
	/**
	 * Nazwa tabeli
	 * @var string
	 */
	protected $_tableName;
	
	/**
	 * Kwantyfikator łączenia AND lub OR
	 * @var string
	 */
	protected $_logic;

	/**
	 * Referencja do nadrzędnego zapytania
	 * @var \Mmi_Dao_Query
	 */
	protected $_query;

	/**
	 * Ustawia parametry pola
	 * @param \Mmi_Dao_Query $query zapytanie nadrzędne
	 * @param string $fieldName nazwa pola
	 * @param string $tableName nazwa tabeli
	 * @param string $logic kwantyfikator łączenia AND lub OR
	 */
	public function __construct(Mmi_Dao_Query $query, $fieldName, $tableName, $logic = 'AND') {
		$this->_fieldName = $fieldName;
		$this->_tableName = $tableName;
		$this->_logic = $logic;
		$this->_query = $query;
	}

	/**
	 * Równość
	 * @param mixed $value
	 * @return \Mmi_Dao_Query
	 */
	public function eqals($value) {
		$this->_query->queryCompilation()->bind[] = array($this->_fieldName, $value, '=', $this->_logic, $this->_tableName);
		return $this->_query;
	}

	/**
	 * Negacja równości
	 * @param mixed $value
	 * @return \Mmi_Dao_Query
	 */
	public function notEquals($value) {
		$this->_query->queryCompilation()->bind[] = array($this->_fieldName, $value, '<>', $this->_logic, $this->_tableName);
		return $this->_query;
	}

	/**
	 * Relacja większości
	 * @param mixed $value
	 * @return \Mmi_Dao_Query
	 */
	public function greater($value) {
		$this->_query->queryCompilation()->bind[] = array($this->_fieldName, $value, '>', $this->_logic, $this->_tableName);
		return $this->_query;
	}

	/**
	 * Relacja mniejszości
	 * @param mixed $value
	 * @return \Mmi_Dao_Query
	 */
	public function less($value) {
		$this->_query->queryCompilation()->bind[] = array($this->_fieldName, $value, '<', $this->_logic, $this->_tableName);
		return $this->_query;
	}

	/**
	 * Relacja większe-równe
	 * @param mixed $value
	 * @return \Mmi_Dao_Query
	 */
	public function greaterOrEquals($value) {
		$this->_query->queryCompilation()->bind[] = array($this->_fieldName, $value, '>=', $this->_logic, $this->_tableName);
		return $this->_query;
	}

	/**
	 * Relacja mniejsze-równe
	 * @param type $value
	 * @return \Mmi_Dao_Query
	 */
	public function lessOrEquals($value) {
		$this->_query->queryCompilation()->bind[] = array($this->_fieldName, $value, '<=', $this->_logic, $this->_tableName);
		return $this->_query;
	}

	/**
	 * Porównanie podobieństwa
	 * @param string $value
	 * @return \Mmi_Dao_Query
	 */
	public function like($value) {
		$this->_query->queryCompilation()->bind[] = array($this->_fieldName, $value, 'LIKE', $this->_logic, $this->_tableName);
		return $this->_query;
	}

}