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
 * Mmi/Model/Dao.php
 * @category   Mmi
 * @package    Mmi_Dao
 * @copyright  Copyright (c) 2012 HQSoft Mariusz Miłejko (http://www.hqsoft.pl)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    $Id$
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */

/**
 * Klasa DAO
 * @category   Mmi
 * @package    Mmi_Dao
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
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
	 * @param array $bind Mmi_Dao_Query lub tabela w postaci: @see Mmi_Db_Adapter_Pdo_Abstract::parseWhereBind()
	 * @param array $joinSchema schemat połączeń
	 * @return int
	 */
	public static final function count($bind = array(), array $joinSchema = array()) {
		//@TODO po refaktoryzacji przerobić by przyjmował tylko obiekt query
		if ($bind instanceof Mmi_Dao_Query) {
			$q = $bind->queryCompilation();
			//@TODO usunąć tego if'a:
			if (!empty($joinSchema)) {
				throw new Exception('Mmi_Dao: query object supplied together with $limit, $offset etc.');
			}
			$result = self::getAdapter()->select(static::$_tableName, $q->bind, array(), null, null, array('COUNT(*)'), $q->joinSchema);
		} else {
			$result = self::getAdapter()->select(static::$_tableName, $bind, array(), null, null, array('COUNT(*)'), $joinSchema);
		}
		return isset($result[0]) ? current($result[0]) : 0;
	}

	/**
	 * Pobiera wszystkie rekordy i zwraca ich kolekcję
	 * @param array $bind Mmi_Dao_Query lub tabela w postaci: @see Mmi_Db_Adapter_Pdo_Abstract::_parseWhereBind()
	 * @param array $order tabela w postaci: @see Mmi_Db_Adapter_Pdo_Abstract::_parseOrderBind()
	 * @param int $limit ilość rekordów
	 * @param int $offset rekord startowy (domyślnie pierwszy)
	 * @param array $joinSchema schemat połączeń
	 * @return Mmi_Dao_Record_Collection
	 */
	public static final function find($bind = array(), array $order = array(), $limit = null, $offset = null, array $joinSchema = array()) {
		//@TODO po refaktoryzacji przerobić by przyjmował tylko obiekt query
		/* @var $q Mmi_Dao_Query_Compilation */
		if ($bind instanceof Mmi_Dao_Query) {
			$q = $bind->queryCompilation();
			//@TODO usunąć tego if'a:
			if ($offset !== null || !empty($order) || !empty($joinSchema)) {
				throw new Exception('Mmi_Dao: query object supplied together with $limit, $offset etc.');
			}
			$result = self::getAdapter()->select(static::$_tableName, $q->bind, $q->order, $q->limit, $q->offset, self::_getFields($q->joinSchema), $q->joinSchema);
		} else {
			$result = self::getAdapter()->select(static::$_tableName, $bind, $order, $limit, $offset, array('*'), $joinSchema);
		}
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
	 * @param array $bind tabela w postaci: @see Mmi_Db_Adapter_Pdo_Abstract::_parseWhereBind()
	 * @param array $order tabela w postaci: @see Mmi_Db_Adapter_Pdo_Abstract::_parseOrderBind()
	 * @param integer $offset rekord startowy (domyślnie pierwszy)
	 * @param array $joinSchema schemat połączeń
	 * @return Mmi_Dao_Record_Ro
	 */
	public static final function findFirst($bind = array(), array $order = array(), $offset = null, array $joinSchema = array()) {
		//@TODO po refaktoryzacji przerobić by przyjmował tylko obiekt query
		if ($bind instanceof Mmi_Dao_Query) {
			$q = $bind->queryCompilation();
			//@TODO usunąć tego if'a:
			if ($offset !== null || !empty($order) || !empty($joinSchema)) {
				throw new Exception('Mmi_Dao: query object supplied together with $limit, $offset etc.');
			}
			$result = self::getAdapter()->select(static::$_tableName, $q->bind, $q->order, 1, $q->offset, self::_getFields($q->joinSchema), $q->joinSchema);
		} else {
			$result = self::getAdapter()->select(static::$_tableName, $bind, $order, 1, $offset, array('*'), $joinSchema);
		}
		if (!is_array($result) || !isset($result[0])) {
			return null;
		}
		$recordName = self::getRecordName();
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
		return ($record->getPk() === null) ? null : $record;
	}

	/**
	 * Pobiera tabelę asocjacyjną klucz => wartość
	 * @param string $keyName nazwa klucza
	 * @param string $valueName nazwa wartości
	 * @param array $bind tabela w postaci: @see Mmi_Db_Adapter_Pdo_Abstract::_parseWhereBind()
	 * @param array $order tabela w postaci: @see Mmi_Db_Adapter_Pdo_Abstract::_parseOrderBind()
	 * @param int $limit ilość rekordów
	 * @param int $offset rekord startowy (domyślnie pierwszy)
	 * @param array $joinSchema schemat połączeń
	 * @return array tablica klucz wartość
	 */
	public static final function findPairs($keyName, $valueName, $bind = array(), array $order = array(), $limit = null, $offset = null, array $joinSchema = array()) {
		//@TODO po refaktoryzacji przerobić by przyjmował tylko obiekt query
		if ($bind instanceof Mmi_Dao_Query) {
			$q = $bind->queryCompilation();
			//@TODO usunąć tego if'a:
			if ($limit !== null || $offset !== null || !empty($order) || !empty($joinSchema)) {
				throw new Exception('Mmi_Dao: query object supplied together with $limit, $offset etc.');
			}
			$data = self::getAdapter()->select(static::$_tableName, $q->bind, $q->order, $q->limit, $q->offset, array($keyName, $valueName), $q->joinSchema);
		} else {
			$data = self::getAdapter()->select(static::$_tableName, $bind, $order, $limit, $offset, array($keyName, $valueName), $joinSchema);
		}
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
	 * @param array $bind tabela w postaci: @see Mmi_Db_Adapter_Pdo_Abstract::_parseWhereBind()
	 * @param array $joinSchema schemat połączeń
	 * @return array mixed wartość maksymalna
	 */
	public static final function findMax($keyName, array $bind = array(), array $joinSchema = array()) {
		//@TODO po refaktoryzacji przerobić by przyjmował tylko obiekt query
		if ($bind instanceof Mmi_Dao_Query) {
			$q = $bind->queryCompilation();
			//@TODO usunąć tego if'a:
			if (!empty($joinSchema)) {
				throw new Exception('Mmi_Dao: query object supplied together with $limit, $offset etc.');
			}
			$result = self::getAdapter()->select(static::$_tableName, $q->bind, array(), 1, 0, array('MAX(' . self::getAdapter()->prepareField($keyName) . ')'), $q->joinSchema);
		} else {
			$result = self::getAdapter()->select(static::$_tableName, $bind, array(), 1, 0, array('MAX(' . self::getAdapter()->prepareField($keyName) . ')'), $joinSchema);
		}
		return isset($result[0]) ? current($result[0]) : 0;
	}

	/**
	 * Pobiera adapter bazodanowy
	 * @return Mmi_Db_Adapter_Pdo_Abstract
	 */
	public static final function getAdapter() {
		if (static::$_tableName === null) {
			throw new Exception('Table name not specified');
		}
		if (!(static::$_adapter instanceof Mmi_Db_Adapter_Pdo_Abstract)) {
			throw new Exception('Adapter not specified or invalid');
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
