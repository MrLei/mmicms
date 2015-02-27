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
 * @package    \Mmi\Dao
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    1.0.0
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */
/**
 * Klasa DAO
 * @category   Mmi
 * @package    \Mmi\Dao
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

namespace Mmi;

class Dao {

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
	 * @var \Mmi\Db\Adapter\Pdo\PdoAbstract
	 */
	protected static $_adapter;

	/**
	 * Obiekt bufora
	 * @var \Mmi\Cache
	 */
	protected static $_cache;

	/**
	 * Nazwa klasy kolekcji rekordów
	 * @var string
	 */
	protected static $_collectionName = '\Mmi\Dao\Record\Collection';

	/**
	 * Nazwa klasy active recordu (jeśli nie podana ustalana jest automatycznie według konwencji)
	 * Przykład konwencji: News\Model\Dao -> News\Model\Record (tabela w DB news)
	 * @var string
	 */
	protected static $_recordName;

	/**
	 * Zabezpieczony konstruktor
	 */
	private final function __construct() {
		throw new\Exception('DAO should be called statically');
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
	 * @return \Mmi\Dao\Record\Ro
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
	 * @return \Mmi\Dao\Record\Ro
	 */
	public static final function findOrCreatePk($id) {
		$recordName = self::getRecordName();
		return new $recordName($id);
	}

	/**
	 * Pobiera adapter bazodanowy
	 * @return \Mmi\Db\Adapter\Pdo\PdoAbstract
	 */
	public static final function getAdapter() {
		if (static::$_tableName === null) {
			throw new\Exception('\Mmi\Dao: Table name not specified');
		}
		if (!(static::$_adapter instanceof \Mmi\Db\Adapter\Pdo\PdoAbstract)) {
			throw new\Exception('\Mmi\Dao: Adapter not specified or invalid');
		}
		return static::$_adapter;
	}

	/**
	 * Ustawia adapter bazodanowy
	 * @param \Mmi\Db\Adapter\Pdo\PdoAbstract $adapter
	 * @return \Mmi\Db\Adapter\Pdo\PdoAbstract
	 */
	public static final function setAdapter(\Mmi\Db\Adapter\Pdo\PdoAbstract $adapter) {
		static::$_adapter = $adapter;
		return $adapter;
	}

	/**
	 * Zwraca obiekt cache
	 * @return \Mmi\Cache
	 */
	public static final function getCache() {
		return static::$_cache;
	}

	/**
	 * Ustawia obiekt cache
	 * @param \Mmi\Cache $cache
	 * @return \Mmi\Cache
	 */
	public static final function setCache(\Mmi\Cache $cache) {
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
		$cacheKey = 'Dao-structure-' . self::getAdapter()->getConfig()->name . '-' . $tableName;
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
		return substr(get_called_class(), 0, -3) . 'Record\Collection';
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
		return implode('\\', $targetTable);
	}

}
