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
	 * Nazwa adaptera DB w rejestrze
	 * @var string
	 */
	protected static $_adapterName = 'Mmi_Db';

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
	private final function __construct() {}

	/**
	 * Zwraca ilość rekordów o podanych parametrach
	 * @param array $bind tabela w postaci: @see Mmi_Db_Adapter_Pdo_Abstract::parseWhereBind()
	 * @param array $joinSchema schemat połączeń
	 * @return int
	 */
	public static final function count(array $bind = array(), array $joinSchema = array()) {
		$result = self::getAdapter()->select(static::$_tableName, $bind, array(), null, null, array('COUNT(*)'), $joinSchema);
		return isset($result[0]) ? current($result[0]) : 0;
	}

	/**
	 * Pobiera wszystkie rekordy i zwraca ich kolekcję
	 * @param array $bind tabela w postaci: @see Mmi_Db_Adapter_Pdo_Abstract::_parseWhereBind()
	 * @param array $order tabela w postaci: @see Mmi_Db_Adapter_Pdo_Abstract::_parseOrderBind()
	 * @param int $limit ilość rekordów
	 * @param int $offset rekord startowy (domyślnie pierwszy)
	 * @param array $joinSchema schemat połączeń
	 * @return Mmi_Dao_Record_Collection
	 */
	public static final function find(array $bind = array(), array $order = array(), $limit = null, $offset = null, array $joinSchema = array()) {
		$result = self::getAdapter()->select(static::$_tableName, $bind, $order, $limit, $offset, array('*'), $joinSchema);
		$collection = new Mmi_Dao_Record_Collection();
		$recordName = self::getRecordName();
		foreach ($result as $row) {
			$record = new $recordName();
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
	public static final function findFirst(array $bind = array(), array $order = array(), $offset = null, array $joinSchema = array()) {
		$result = self::getAdapter()->select(static::$_tableName, $bind, $order, 1, $offset, array('*'), $joinSchema);
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
	public static final function findPairs($keyName, $valueName, array $bind = array(), array $order = array(), $limit = null, $offset = null, array $joinSchema = array()) {
		$data = self::getAdapter()->select(static::$_tableName, $bind, $order, $limit, $offset, array($keyName, $valueName), $joinSchema);
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
		$result = self::getAdapter()->select(static::$_tableName, $bind, array(), 1, 0, array('MAX(' . self::getAdapter()->prepareField($keyName) . ')'), $joinSchema);
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
		$adapter = Mmi_Registry::get(static::$_adapterName);
		if (!$adapter instanceof Mmi_Db_Adapter_Pdo_Abstract) {
			throw new Exception('Adapter not specified or invalid');
		}
		return $adapter;
	}

	/**
	 * Pobiera strukturę tabeli
	 * @return array
	 */
	public static final function getTableStructure() {
		$cacheKey = 'Dao_structure_' . static::$_tableName . '_' . self::$_adapterName;
		if (!Mmi_Config::$data['cache']['active'] || !($structure = Mmi_Cache::getInstance()->load($cacheKey))) {
			$structure = self::getAdapter()->tableInfo(static::$_tableName);
			if (Mmi_Config::$data['cache']['active']) {
				Mmi_Cache::getInstance()->save($structure, $cacheKey, 28800);
			}
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

}