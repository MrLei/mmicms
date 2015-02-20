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
 * Mmi/Dao/Query/Field.php
 * @category   Mmi
 * @package    \Mmi\Dao
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    1.0.0
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

/**
 * Klasa pola w zapytaniu
 * @category   Mmi
 * @package    \Mmi\Dao
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

namespace Mmi\Dao\Query;

class Field {

	/**
	 * Nazwa pola
	 * @var string
	 */
	protected $_fieldName;

	/**
	 * Kwantyfikator łączenia AND lub OR
	 * @var string
	 */
	protected $_logic;

	/**
	 * Referencja do nadrzędnego zapytania
	 * @var \Mmi\Dao\Query
	 */
	protected $_query;

	/**
	 * Ustawia parametry pola
	 * @param \Mmi\Dao\Query $query zapytanie nadrzędne
	 * @param string $fieldName nazwa pola
	 * @param string $logic kwantyfikator łączenia AND lub OR
	 */
	public function __construct(\Mmi\Dao\Query $query, $fieldName, $logic = 'AND') {
		$this->_fieldName = $fieldName;
		$this->_logic = ($logic == 'OR') ? 'OR' : 'AND';
		$this->_query = $query;
	}

	/**
	 * Równość
	 * @param mixed $value
	 * @return \Mmi\Dao\Query
	 */
	public function equals($value) {
		return $this->_prepareQuery($value, '=');
	}

	/**
	 * Negacja równości
	 * @param mixed $value
	 * @return \Mmi\Dao\Query
	 */
	public function notEquals($value) {
		return $this->_prepareQuery($value, '<>');
	}

	/**
	 * Relacja większości
	 * @param mixed $value
	 * @return \Mmi\Dao\Query
	 */
	public function greater($value) {
		return $this->_prepareQuery($value, '>');
	}

	/**
	 * Relacja mniejszości
	 * @param mixed $value
	 * @return \Mmi\Dao\Query
	 */
	public function less($value) {
		return $this->_prepareQuery($value, '<');
	}

	/**
	 * Relacja większe-równe
	 * @param mixed $value
	 * @return \Mmi\Dao\Query
	 */
	public function greaterOrEquals($value) {
		return $this->_prepareQuery($value, '>=');
	}

	/**
	 * Relacja mniejsze-równe
	 * @param type $value
	 * @return \Mmi\Dao\Query
	 */
	public function lessOrEquals($value) {
		return $this->_prepareQuery($value, '<=');
	}

	/**
	 * Porównanie podobieństwa
	 * @param string $value
	 * @return \Mmi\Dao\Query
	 */
	public function like($value) {
		return $this->_prepareQuery($value, 'LIKE');
	}

	/**
	 * Porównanie podobieństwa bez wielkości liter
	 * @param string $value
	 * @return \Mmi\Dao\Query
	 */
	public function ilike($value) {
		return $this->_prepareQuery($value, 'ILIKE');
	}

	/**
	 * Przygotowuje zapytanie
	 * @param mixed $value
	 * @param string $condition
	 * @return \Mmi\Dao\Query
	 */
	protected function _prepareQuery($value, $condition = '=') {
		//tworzenie binda
		$bindKey = \Mmi\Db\Adapter\Pdo\PdoAbstract::generateRandomBindKey();
		if (!is_array($value) && null !== $value) {
			$this->_query->getQueryCompile()->bind[$bindKey] = $value;
		}
		if ($this->_query->getQueryCompile()->where == '') {
			$this->_query->getQueryCompile()->where = 'WHERE ';
		} else {
			$this->_query->getQueryCompile()->where .= ' ' . $this->_logic . ' ';
		}
		$dao = $this->_query->getDaoClassName();
		/* @var $db \Mmi\Db\Adapter\Pdo\Abstract */
		$db = $dao::getAdapter();
		//sprawdzenie wartości null
		if (null === $value) {
			$this->_query->getQueryCompile()->where .= $db->prepareNullCheck($this->_fieldName, ($condition == '='));
			return $this->_query;
		}
		//sprawdzenie typów tabelarycznych
		if (is_array($value)) {
			$fields = '';
			$i = 1;
			foreach ($value as $arg) {
				$bk = \Mmi\Db\Adapter\Pdo\PdoAbstract::generateRandomBindKey();
				$this->_query->getQueryCompile()->bind[$bk] = $arg;
				$fields .= ':' . $bk . ', ';
				$i++;
			}
			$this->_query->getQueryCompile()->where .= $this->_fieldName . ' ' . ($condition == '<>' ? 'NOT IN' : 'IN') . '(' . trim($fields, ', ') . ')';
			return $this->_query;
		}
		//ilike
		if ('ILIKE' == $condition) {
			$this->_query->getQueryCompile()->where .= $db->prepareIlike($this->_fieldName) . ' :' . $bindKey;
			return $this->_query;
		}
		//zwykłe porównanie
		$this->_query->getQueryCompile()->where .= $this->_fieldName . ' ' . $condition . ' :' . $bindKey;
		return $this->_query;
	}

}
