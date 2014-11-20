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
 * Mmi/Model/Dao.php
 * @category   Mmi
 * @package    Mmi_Dao
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    1.0.0
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

/**
 * Klasa DAO
 * @category   Mmi
 * @package    Mmi_Dao
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */
class Mmi_Dao {

	/**
	 * Nazwa tabeli
	 * @var string
	 */
	protected static $_tableName;

	/**
	 * Adapter DB
	 * @var Mmi_Db_Adapter_Pdo_Abstract
	 */
	protected static $_adapter;

	/**
	 * Obiekt bufora
	 * @var Mmi_Cache
	 */
	protected static $_cache;

	/**
	 * Nazwa klasy kolekcji rekordów
	 * @var string
	 */
	protected static $_collectionName = 'Mmi_Dao_Record_Collection';

	/**
	 * Nazwa klasy active recordu (jeśli nie podana ustalana jest automatycznie według konwencji)
	 * Przykład konwencji: News_Model_Dao -> News_Model_Record (tabela w DB news)
	 * @var string
	 */
	protected static $_recordName;

	/**
	 * Zabezpieczony konstruktor
	 */
	private final function __construct() {
		
	}

	/**
	 * Zwraca ilość rekordów o podanych parametrach
	 * @param Mmi_Dao_Query $q Obiekt zapytania
	 * @return int
	 */
	public static final function count(Mmi_Dao_Query $q = null) {
		$q = ($q === null) ? self::newQuery() : $q;
		$compile = $q->queryCompilation();
		$result = self::getAdapter()->select(static::$_tableName, $compile->bind, array(), null, null, array('COUNT(*)'), $compile->joinSchema);
		return isset($result[0]) ? current($result[0]) : 0;
	}

	/**
	 * Pobiera wszystkie rekordy i zwraca ich kolekcję
	 * @param Mmi_Dao_Query $q Obiekt zapytania
	 * @return Mmi_Dao_Record_Collection
	 */
	public static final function find(Mmi_Dao_Query $q = null) {
		$q = ($q === null) ? self::newQuery() : $q;
		$compile = $q->queryCompilation();
		$result = self::getAdapter()->select(static::$_tableName, $compile->bind, $compile->order, $compile->limit, $compile->offset, self::_getFields($compile->joinSchema), $compile->joinSchema);
		$collection = new Mmi_Dao_Record_Collection();
		$recordName = self::getRecordName();
		foreach ($result as $row) {
			$record = new $recordName();
			/* @var $record Mmi_Dao_Record */
			$record->setFromArray($row)->clearModified()->setNew(false);
			$collection->append($record);
		}
		return $collection;
	}

	/**
	 * Pobiera obiekt pierwszy ze zbioru
	 * @param Mmi_Dao_Query $q Obiekt zapytania
	 * @return Mmi_Dao_Record_Ro
	 */
	public static final function findFirst(Mmi_Dao_Query $q = null) {
		$q = ($q === null) ? self::newQuery() : $q;
		$compile = $q->queryCompilation();
		$result = self::getAdapter()->select(static::$_tableName, $compile->bind, $compile->order, 1, $compile->offset, self::_getFields($compile->joinSchema), $compile->joinSchema);
		if (!is_array($result) || !isset($result[0])) {
			return null;
		}
		$recordName = self::getRecordName();
		/* @var $record Mmi_Dao_Record_Ro */
		$record = new $recordName;
		$record->setFromArray($result[0])->clearModified()->setNew(false);
		return $record;
	}

	/**
	 * Pobiera obiekt po kluczu głównym
	 * @param mixed $id identyfikator
	 * @return Mmi_Dao_Record_Ro
	 */
	public static final function findPk($id) {
		$recordName = self::getRecordName();
		$record = new $recordName($id);
		if ($record->getPk() !== null) {
			return $record;
		}
	}

	/**
	 * Pobiera obiekt po kluczu głównym, lub tworzy nowy jeśli brak
	 * @param mixed $id identyfikator
	 * @return Mmi_Dao_Record_Ro
	 */
	public static final function findOrCreatePk($id) {
		$recordName = self::getRecordName();
		return new $recordName($id);
	}

	/**
	 * Pobiera tabelę asocjacyjną klucz => wartość
	 * @param string $keyName nazwa klucza
	 * @param string $valueName nazwa wartości
 	 * @param Mmi_Dao_Query $q Obiekt zapytania
	 * @return array tablica klucz wartość
	 */
	public static final function findPairs($keyName, $valueName, Mmi_Dao_Query $q = null) {
		$q = ($q === null) ? self::newQuery() : $q;
		$compile = $q->queryCompilation();
		$data = self::getAdapter()->select(static::$_tableName, $compile->bind, $compile->order, $compile->limit, $compile->offset, array($keyName, $valueName), $compile->joinSchema);
		$kv = array();
		foreach ($data as $line) {
			if (count($line) == 1) {
				$value = current($line);
				if (is_array($value) && count($value) == 2) {
					$kv[$value[0]] = $value[1];
					continue;
				}
				continue;
			}
			$kv[current($line)] = next($line);
		}
		return $kv;
	}

	/**
	 * Pobiera wartość maksymalną ze zbioru rekordów
	 * @param string $keyName nazwa klucza
	 * @param Mmi_Dao_Query $q Obiekt zapytania
	 * @return array mixed wartość maksymalna
	 */
	public static final function findMax($keyName, Mmi_Dao_Query $q = null) {
		$q = ($q === null) ? self::newQuery() : $q;
		$compile = $q->queryCompilation();
		$result = self::getAdapter()->select(static::$_tableName, $compile->bind, array(), 1, 0, array('MAX(' . self::getAdapter()->prepareField($keyName) . ')'), $compile->joinSchema);
		return isset($result[0]) ? current($result[0]) : null;
	}
	
	/**
	 * Pobiera wartość minimalną ze zbioru rekordów
	 * @param string $keyName nazwa klucza
	 * @param Mmi_Dao_Query $q Obiekt zapytania
	 * @return array mixed wartość minimalna
	 */
	public static final function findMin($keyName, Mmi_Dao_Query $q = null) {
		$q = ($q === null) ? self::newQuery() : $q;
		$compile = $q->queryCompilation();
		$result = self::getAdapter()->select(static::$_tableName, $compile->bind, array(), 1, 0, array('MIN(' . self::getAdapter()->prepareField($keyName) . ')'), $compile->joinSchema);
		return isset($result[0]) ? current($result[0]) : null;
	}

	/**
	 * Pobiera unikalne wartości ze zbioru rekordów
	 * @param string $keyName nazwa klucza
	 * @param Mmi_Dao_Query $q Obiekt zapytania
	 * @return array mixed wartość maksymalna
	 */
	public static final function findUnique($keyName, Mmi_Dao_Query $q = null) {
		$q = ($q === null) ? self::newQuery() : $q;
		$compile = $q->queryCompilation();
		$data = self::getAdapter()->select(static::$_tableName, $compile->bind, $compile->order, $compile->limit, $compile->offset, array('DISTINCT(' . self::getAdapter()->prepareField($keyName) . ')'), $compile->joinSchema);
		$result = array();
		foreach ($data as $line) {
			$result[] = current($line);
		}
		return $result;
	}

	/**
	 * Pobiera adapter bazodanowy
	 * @return Mmi_Db_Adapter_Pdo_Abstract
	 */
	public static final function getAdapter() {
		if (static::$_tableName === null) {
			throw new Exception('Mmi_Dao: Table name not specified');
		}
		if (!(static::$_adapter instanceof Mmi_Db_Adapter_Pdo_Abstract)) {
			throw new Exception('Mmi_Dao: Adapter not specified or invalid');
		}
		return static::$_adapter;
	}

	/**
	 * Ustawia adapter bazodanowy
	 * @param Mmi_Db_Adapter_Pdo_Abstract $adapter
	 * @return \Mmi_Db_Adapter_Pdo_Abstract
	 */
	public static final function setAdapter(Mmi_Db_Adapter_Pdo_Abstract $adapter) {
		static::$_adapter = $adapter;
		return $adapter;
	}

	/**
	 * Zwraca obiekt cache
	 * @return Mmi_Cache
	 */
	public static final function getCache() {
		return static::$_cache;
	}

	/**
	 * Ustawia obiekt cache
	 * @param Mmi_Cache $cache
	 * @return \Mmi_Cache
	 */
	public static final function setCache(Mmi_Cache $cache) {
		static::$_cache = $cache;
		return $cache;
	}

	/**
	 * Pobiera strukturę tabeli
	 * @param string $tableName opcjonalna nazwa tabeli
	 * @return array
	 */
	public static final function getTableStructure($tableName = null) {
		if ($tableName === null) {
			$tableName = static::$_tableName;
		}
		$cacheKey = 'Dao_structure_' . self::getAdapter()->getConfig()->name . '_' . $tableName;
		if (static::$_cache !== null && (null !== ($structure = static::$_cache->load($cacheKey)))) {
			return $structure;
		}
		$structure = static::getAdapter()->tableInfo($tableName);
		if (static::$_cache !== null) {
			static::$_cache->save($structure, $cacheKey, 28800);
		}
		return $structure;
	}

	/**
	 * Pobiera nazwę tabeli
	 * @return array
	 */
	public static final function getTableName() {
		return static::$_tableName;
	}

	/**
	 * Zwraca nazwę klasy rekordu
	 * @return string
	 */
	public static final function getRecordName() {
		if (static::$_recordName !== null) {
			return static::$_recordName;
		}
		return substr(get_called_class(), 0, -3) . 'Record';
	}
	
	/**
	 * Zwraca nazwę rekordu dla podanej tabeli
	 * @param string $tableName
	 * @return string
	 */
	public static final function getRecordNameByTable($tableName) {
		$tableArray = explode('_', $tableName);
		$firstElement = $tableArray[0];
		array_shift($tableArray);
		array_unshift($tableArray, $firstElement, 'Model');
		$tableArray[] = 'Record';
		$targetTable = array();
		foreach ($tableArray as $key => $element) {
			$targetTable[$key] = ucfirst($element);
		}
		return implode('_', $targetTable);
	}

	/**
	 * Zwraca nowy obiekt zapytania
	 * @return \Mmi_Dao_Query
	 */
	public static final function newQuery() {
		return new Mmi_Dao_Query();
	}

	/**
	 * Zwraca pola do selecta
	 * @param array $joinSchema
	 * @return string
	 */
	protected static function _getFields($joinSchema) {
		if (empty($joinSchema)) {
			return array('*');
		}
		$fields = array();
		$mainStructure = self::getTableStructure();
		foreach ($mainStructure as $field => $info) {
			$fields[] = self::getTableName() . '.' . $field;
		}
		foreach ($joinSchema as $tableName => $schema) {
			unset($schema);
			$structure = self::getTableStructure($tableName);
			foreach ($structure as $field => $info) {
				$fields[] = $tableName . '.' . $field . ' AS ' . $tableName . '__' . $field;
			}
		}
		return $fields;
	}

}
