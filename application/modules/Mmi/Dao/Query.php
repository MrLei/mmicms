<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Mmi\Dao;

/**
 * Klasa zapytania powoływana przez Query::factory()
 * umożliwia odpytywanie DAO o Rekordy
 */
class Query {

	/**
	 * Kompilant zapytania
	 * @var \Mmi\Dao\Query\Compile
	 */
	protected $_compile;

	/**
	 * Nazwa klasy DAO
	 * @var string
	 */
	protected $_daoClassName;

	/**
	 * Konstruktor tworzy nowe skompilowane zapytanie
	 * @param string $daoClassName nazwa klasy DAO
	 */
	protected final function __construct($daoClassName = null) {
		//nowa kompilacja
		$this->_compile = new \Mmi\Dao\Query\Compile();
		//klasa DAO na podstawie parametru konstruktora
		if ($daoClassName !== null) {
			$this->_daoClassName = $daoClassName;
			return;
		}
		//jeśli ustalona klasa - wyjście
		if ($this->_daoClassName !== null) {
			return;
		}
		//jeśli brakuje klasy, stosowana jest konwencja nazw
		$this->_daoClassName = substr(get_called_class(), 0, -5) . 'Dao';
	}

	/**
	 * Magiczne wywołanie metod where, order itd.
	 * @param type $name
	 * @param type $params
	 * @return \Mmi\Dao\Query
	 */
	public final function __call($name, $params) {
		//znajdowanie 2 podciągów: 1 - nazwa metody, 2 - wartość pola
		if (!preg_match('/(where|andField|orField|orderAsc|orderDesc)([a-zA-Z0-9]+)/', $name, $matches) || !empty($params)) {
			//brak metody pasującej do wzorca
			throw new \Exception('\Mmi\Dao\Query: method not found ' . $name);
		}
		//wywołanie metody
		return $this->{$matches[1]}(lcfirst($matches[2]));
	}

	/**
	 * Zwraca instancję siebie
	 * @return self
	 */
	public static function factory($daoClassName = null) {
		//nowy obiekt swojej klasy
		return new self($daoClassName);
	}

	/**
	 * Ustawia limit
	 * @param int $limit
	 * @return \Mmi\Dao\Query
	 */
	public final function limit($limit = null) {
		$this->_compile->limit = $limit;
		return $this;
	}

	/**
	 * Ustawia ofset
	 * @param int $offset
	 * @return \Mmi\Dao\Query
	 */
	public final function offset($offset = null) {
		$this->_compile->offset = $offset;
		return $this;
	}

	/**
	 * Sortowanie rosnące
	 * @param string $fieldName nazwa pola
	 * @param string $tableName opcjonalna nazwa tabeli źródłowej
	 * @return \Mmi\Dao\Query
	 */
	public final function orderAsc($fieldName, $tableName = null) {
		return $this->_prepareOrder($fieldName, $tableName);
	}

	/**
	 * Sortowanie malejące
	 * @param string $fieldName nazwa pola
	 * @param string $tableName opcjonalna nazwa tabeli źródłowej
	 * @return \Mmi\Dao\Query
	 */
	public final function orderDesc($fieldName, $tableName = null) {
		return $this->_prepareOrder($fieldName, $tableName, false);
	}

	/**
	 * Dodaje podsekcję AND
	 * @param \Mmi\Dao\Query $query
	 * @return \Mmi\Dao\Query
	 */
	public final function andQuery(\Mmi\Dao\Query $query) {
		return $this->_mergeQueries($query, true);
	}

	/**
	 * Dodaje podsekcję WHERE (jak AND)
	 * @param \Mmi\Dao\Query $query
	 * @return \Mmi\Dao\Query
	 */
	public final function whereQuery(\Mmi\Dao\Query $query) {
		//jest aliasem na metodę andQuery()
		return $this->andQuery($query);
	}

	/**
	 * Dodaje podsekcję OR
	 * @param \Mmi\Dao\Query $query
	 * @return \Mmi\Dao\Query
	 */
	public final function orQuery(\Mmi\Dao\Query $query) {
		return $this->_mergeQueries($query, false);
	}

	/**
	 * Dodaje warunek na pole AND
	 * @param string $fieldName nazwa pola
	 * @param string $tableName opcjonalna nazwa tabeli źródłowej
	 * @return \Mmi\Dao\Query\Field
	 */
	public final function andField($fieldName, $tableName = null) {
		return new \Mmi\Dao\Query\Field($this, $this->_prepareField($fieldName, $tableName), 'AND');
	}

	/**
	 * Pierwszy warunek w zapytaniu (domyślnie AND)
	 * @param string $fieldName nazwa pola
	 * @param string $tableName opcjonalna nazwa tabeli źródłowej
	 * @return \Mmi\Dao\Query\Field
	 */
	public final function where($fieldName, $tableName = null) {
		return $this->andField($fieldName, $tableName);
	}

	/**
	 * Dodaje warunek na pole OR
	 * @param string $fieldName nazwa pola
	 * @param string $tableName opcjonalna nazwa tabeli źródłowej
	 * @return \Mmi\Dao\Query\Field
	 */
	public final function orField($fieldName, $tableName = null) {
		return new \Mmi\Dao\Query\Field($this, $this->_prepareField($fieldName, $tableName), 'OR');
	}

	/**
	 * Dołącza tabelę tabelę
	 * @param string $tableName nazwa tabeli
	 * @param string $targetTableName opcjonalnie nazwa tabeli do której łączyć
	 * @return \Mmi\Dao\Query\Join
	 */
	public final function join($tableName, $targetTableName = null) {
		return new \Mmi\Dao\Query\Join($this, $tableName, 'JOIN', $targetTableName);
	}

	/**
	 * Dołącza tabelę złączeniem lewym
	 * @param string $tableName nazwa tabeli
	 * @param string $targetTableName opcjonalnie nazwa tabeli do której łączyć
	 * @return \Mmi\Dao\Query\Join
	 */
	public final function joinLeft($tableName, $targetTableName = null) {
		return new \Mmi\Dao\Query\Join($this, $tableName, 'LEFT JOIN', $targetTableName);
	}

	/**
	 * Zwraca skompilowane zapytanie
	 * @return \Mmi\Dao\Query\Compile
	 */
	public final function getQueryCompile() {
		return $this->_compile;
	}

	/**
	 * Zwraca skrót MD5 zapytania
	 * @return string
	 */
	public final function getQueryCompileHash() {
		return md5(print_r($this->_compile, true));
	}

	/**
	 * Zwraca nazwę klasy DAO
	 * @return string
	 */
	public final function getDaoClassName() {
		return $this->_daoClassName;
	}

	/**
	 * Resetuje sortowanie w zapytaniu
	 * @return \Mmi\Dao\Query
	 */
	public final function resetOrder() {
		$this->_compile->order = '';
		return $this;
	}

	/**
	 * Resetuje warunki w zapytaniu
	 * @return \Mmi\Dao\Query
	 */
	public final function resetWhere() {
		//czyszczenie zapytania
		$this->_compile->where = '';
		//usuwanie powiązane zmienne
		$this->_compile->bind = array();
		return $this;
	}

	/**
	 * Pobiera ilość rekordów
	 * @return int
	 */
	public final function count() {
		return Query\Data::factory($this)
				->count();
	}

	/**
	 * Pobiera pierwszy rekord po kluczu głównym ID
	 * null jeśli brak danych
	 * @param int $id
	 * @return \Mmi\Dao\Record
	 */
	public final function findPk($id) {
		//zwróci null jeśli brak danych
		return $this->where('id')->equals($id)
				->findFirst();
	}

	/**
	 * Pobiera wszystkie rekordy i zwraca ich kolekcję
	 * @return \Mmi\Dao\Record\Collection
	 */
	public final function find() {
		return Query\Data::factory($this)
				->find();
	}

	/**
	 * Pobiera obiekt pierwszy ze zbioru
	 * null jeśli brak danych
	 * @param \Mmi\Dao\Query $q Obiekt zapytania
	 * @return \Mmi\Dao\Record\Ro
	 */
	public final function findFirst() {
		return Query\Data::factory($this)
				->findFirst();
	}

	/**
	 * Zwraca tablicę asocjacyjną (pary)
	 * @param string $keyName
	 * @param string $valueName
	 * @return array
	 */
	public final function findPairs($keyName, $valueName) {
		return Query\Data::factory($this)
				->findPairs($keyName, $valueName);
	}

	/**
	 * Pobiera wartość maksymalną z kolumny
	 * @param string $keyName nazwa klucza
	 * @return string wartość maksymalna
	 */
	public final function findMax($keyName) {
		return Query\Data::factory($this)
				->findMax($keyName);
	}

	/**
	 * Pobiera wartość minimalną z kolumny
	 * @param string $keyName nazwa klucza
	 * @return string wartość minimalna
	 */
	public final function findMin($keyName) {
		return Query\Data::factory($this)
				->findMin($keyName);
	}

	/**
	 * Pobiera unikalne wartości kolumny
	 * @param string $keyName nazwa klucza
	 * @return array mixed wartości unikalne
	 */
	public final function findUnique($keyName) {
		return Query\Data::factory($this)
				->findUnique($keyName);
	}

	/**
	 * Łączy query
	 * @param boolean $type
	 * @return \Mmi\Dao\Query
	 */
	protected final function _mergeQueries(\Mmi\Dao\Query $query, $and = true) {
		$compilation = $query->getQueryCompile();
		//łączenie where
		if ($compilation->where) {
			$connector = $this->_compile->where ? ($and ? ' AND (' : ' OR (') : 'WHERE (';
			$this->_compile->where .= $connector . substr($compilation->where, 6) . ')';
		}
		//łączenie wartości
		if (!empty($compilation->bind)) {
			$this->_compile->bind = array_merge($compilation->bind, $this->_compile->bind);
		}
		//suma joinów query nadrzędnej i podrzędnej
		if (!empty($compilation->joinSchema)) {
			$this->_compile->joinSchema = array_merge($this->_compile->joinSchema, $compilation->joinSchema);
		}
		//łączenie order
		if ($compilation->order) {
			if (substr($this->_compile->order, 0, 8) == 'ORDER BY' && substr($compilation->order, 0, 8) == 'ORDER BY') {
				$this->_compile->order .= ', ' . substr($compilation->order, 9);
			} else {
				$this->_compile->order .= $compilation->order;
			}
		}
		return $this;
	}

	/**
	 * Przygotowuje nazwę pola do zapytania, konwertuje camelcase na podkreślenia
	 * @param string $fieldName
	 * @param string $tableName
	 * @return string
	 * @throws Exception
	 */
	protected final function _prepareField($fieldName, $tableName = null) {
		$dao = $this->_daoClassName;
		/* @var $db \Mmi\Db\Adapter\Pdo\PdoAbstract */
		$db = $dao::getAdapter();
		//tabela
		$tablePrefix = $db->prepareTable(($tableName === null) ? $dao::getTableName() : $tableName);
		//jeśli pole występuje w tabeli, bądź jest funkcją RAND()
		if ($dao::fieldInTable($fieldName, $tableName) || $fieldName == 'RAND()') {
			return $tablePrefix . '.' . $db->prepareField($fieldName);
		}
		/* @var $db \Mmi\Db\Adapter\Pdo\PdoAbstract */
		//konwersja camelcase do podkreślników (przechowywanych w bazie)
		$convertedFieldName = \Mmi\Dao::convertCamelcaseToUnderscore($fieldName);
		//jeśli pole podkreślnikowe występuje w bazie
		if ($dao::fieldInTable($convertedFieldName, $tableName)) {
			return $tablePrefix . '.' . $db->prepareField($convertedFieldName);
		}
		//w pozostałych wypadkach wyjątek o braku pola
		throw new \Exception(get_called_class() . ': "' . $fieldName . '" not found in ' . ($tableName !== null ? '"' . $tableName . '" table' : '"' . $dao::getTableName() . '"' . ' table'));
	}

	/**
	 * Przygotowuje order
	 * @param string $fieldName
	 * @param string $tableName
	 * @param boolean $asc
	 * @return \Mmi\Dao\Query
	 */
	protected final function _prepareOrder($fieldName, $tableName = null, $asc = true) {
		//jeśli pusty order - dodawanie ORDER BY na początku
		if (!$this->_compile->order) {
			$this->_compile->order = 'ORDER BY ';
		} else {
			$this->_compile->order .= ', ';
		}
		$this->_compile->order .= $this->_prepareField($fieldName, $tableName) . ' ' . ($asc ? 'ASC' : 'DESC');
		return $this;
	}

}
