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
 * Mmi/Dao/Query/Join.php
 * @category   Mmi
 * @package    Mmi_Dao
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    1.0.0
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

/**
 * Klasa połączeń w zapytaniu
 * @category   Mmi
 * @package    Mmi_Dao
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */
class Mmi_Dao_Query_Join {

	/**
	 * Referencja do nadrzędnego zapytania
	 * @var Mmi_Dao_Query
	 */
	protected $_query;
	
	/**
	 * Nazwa tabeli
	 * @var string
	 */
	protected $_tableName;

	/**
	 * Nazwa do której wykonać łączenie
	 * @var string
	 */
	protected $_targetTableName;
	
	/**
	 * Typ złączenia 'JOIN' 'LEFT JOIN' 'INNER JOIN' 'RIGHT JOIN'
	 * @var string
	 */
	protected $_type;

	/**
	 * Ustawia parametry połączenia
	 * @param Mmi_Dao_Query $query
	 * @param string $tableName nazwa tabeli
	 * @param string $type typ złączenia: 'JOIN', 'LEFT JOIN', 'INNER JOIN', 'RIGHT JOIN'
	 * @param string $targetTableName opcjonalna tabela do której złączyć
	 */
	public function __construct(Mmi_Dao_Query $query, $tableName, $type = 'JOIN', $targetTableName = null) {
		$this->_query = $query;
		$this->_tableName = $tableName;
		$this->_targetTableName = $targetTableName;
		$this->_type = $type;
	}
	
	/**
	 * Warunek złączenia
	 * @param string $localKeyName nazwa lokalnego klucza
	 * @param string $joinedKeyName nazwa klucza w łączonej tabeli
	 * @return Mmi_Dao_Query
	 */
	public function on($localKeyName, $joinedKeyName = 'id') {
		$this->_query->queryCompilation()->joinSchema[$this->_tableName] = array($joinedKeyName, $localKeyName, $this->_targetTableName, $this->_type);
		return $this->_query;
	}

}
