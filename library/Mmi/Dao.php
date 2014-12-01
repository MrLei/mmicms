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
	 * Przechowuje strukturę bazy danych
	 * @var array
	 */
	protected static $_tableStructure = array();

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
	 * Nazwa klasy zapytania (jeśli nie podana ustalana jest automatycznie według konwencji)
	 * Przykład konwencji: News_Model_Dao -> News_Model_Query (tabela w DB news)
	 * @var string
	 */
	protected static $_queryName;

	/**
	 * Zabezpieczony konstruktor
	 */
	private final function __construct() {
		throw new Exception('DAO should be called statically');
	}
	
	/**
	 * Konwertuje podkreślenia na camelcase
	 * @param string $value
	 * @return string
	 */
	public static final function convertUnderscoreToCamelcase($value) {
		return preg_replace_callback('/\_([a-z0-9])/', function ($matches) {
			return ucfirst($matches[1]);
		}, $value);
	}

	/**
	 * Konwertuje camelcase na podkreślenia
	 * @param string $value
	 * @return string
	 */
	public static final function convertCamelcaseToUnderscore($value) {
		return preg_replace_callback('/([A-Z])/', function ($matches) {
			return '_' . lcfirst($matches[1]);
		}, $value);
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
	 * @return Mmi_Db_Adapter_Pdo_Abstract
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
		if (isset(self::$_tableStructure[$tableName])) {
			return self::$_tableStructure[$tableName];
		} 
		$cacheKey = 'Dao_structure_' . self::getAdapter()->getConfig()->name . '_' . $tableName;
		if (static::$_cache !== null && (null !== ($structure = static::$_cache->load($cacheKey)))) {
			return $structure;
		}
		$structure = static::getAdapter()->tableInfo($tableName);
		if (static::$_cache !== null) {
			static::$_cache->save($structure, $cacheKey, 28800);
		}
		self::$_tableStructure[$tableName] = $structure;
		return $structure;
	}
	
	/**
	 * Resetuje struktury tabel i usuwa cache
	 * @return boolean
	 */
	public static final function resetTableStructures() {
		foreach (self::getAdapter()->tableList() as $tableName) {
			$cacheKey = 'Dao_structure_' . self::getAdapter()->getConfig()->name . '_' . $tableName;
			static::$_cache->remove($cacheKey);
		}
		self::$_tableStructure = array();
		return true;
	}
	
	/**
	 * Zwraca obecność pola w tabeli
	 * @param string $fieldName nazwa pola
	 * @param string $tableName opcjonalna nazwa tabeli
	 * @return boolean
	 */
	public static final function fieldInTable($fieldName, $tableName = null) {
		$structure = self::getTableStructure($tableName);
		return isset($structure[$fieldName]);
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
	 * Zwraca nazwę klasy zapytania
	 * @return string
	 */
	public static final function getCollectionName() {
		if (static::$_collectionName !== null) {
			return static::$_collectionName;
		}
		return substr(get_called_class(), 0, -3) . 'Record_Collection';
	}
	
	/**
	 * Zwraca nazwę klasy zapytania
	 * @return string
	 */
	public static final function getQueryName() {
		if (static::$_queryName !== null) {
			return static::$_queryName;
		}
		return substr(get_called_class(), 0, -3) . 'Query';
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
	 * @return Mmi_Dao_Query
	 */
	public static final function newQuery() {
		$queryClassName = self::getQueryName();
		return new $queryClassName(get_called_class());
	}

}
