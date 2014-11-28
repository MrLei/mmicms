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
 * Klasa buildera do DAO
 * @category   Mmi
 * @package    Mmi_Dao
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */
class Mmi_Dao_Builder {

	/**
	 * Renderuje DAO, Record i Query dla podanej nazwy tabeli
	 * @param string $tableName
	 * @throws Exception
	 */
	public static function buildFromTableName($tableName) {
		self::_updateDao($tableName);
		self::_updateQueryField($tableName);
		self::_updateQueryJoin($tableName);
		self::_updateQuery($tableName);
		self::_updateRecord($tableName);
	}

	protected static function _updateDao($tableName) {
		$pathPrefix = self::_getPathPrefixByTableName($tableName);
		$classPrefix = self::_getClassNamePrefixByTableName($tableName);
		$className = $classPrefix . '_Dao';
		$queryClassName = $classPrefix . '_Query';
		$path = $pathPrefix . '/Dao.php';
		self::_mkdirRecursive($path);
		$daoCode = '<?php' . "\n\n" .
			'class ' .
			$className .
			' extends Mmi_Dao {' .
			"\n\n\t" .
			'protected static $_tableName = \'' .
			$tableName . '\';' .
			"\n\n" .
			'}';
		if (file_exists($path)) {
			$daoCode = file_get_contents($path);
		}
		$annotation = '/**' . "\n" .
			' * @method ' . $queryClassName . ' newQuery() newQuery()' . "\n" .
			' */' . "\n";
		if (strpos($daoCode, '* @method ' . $queryClassName) !== false) {
			echo 'DAO completed.';
			return;
		}
		$daoCode = preg_replace('/(class [a-zA-Z0-9_]+ extends [a-zA-Z0-9_]+\s\{?\n?)/', $annotation . '$1' , $daoCode);
		file_put_contents($path, $daoCode);
	}

	/**
	 * Tworzy, lub aktualizuje rekord
	 * @param string $tableName
	 */
	protected static function _updateRecord($tableName) {
		$pathPrefix = self::_getPathPrefixByTableName($tableName);
		$classPrefix = self::_getClassNamePrefixByTableName($tableName);
		$className = $classPrefix . '_Record';
		$daoClassName = $classPrefix . '_Dao';
		$path = $pathPrefix . '/Record.php';
		self::_mkdirRecursive($path);
		$recordCode = '<?php' . "\n\n" .
			'class ' .
			$className .
			' extends Mmi_Dao_Record {' .
			"\n\n" .
			'}';
		if (file_exists($path)) {
			$recordCode = file_get_contents($path);
		}
		$structure = $daoClassName::getTableStructure();
		if (empty($structure)) {
			throw new Exception('Mmi_Dao_Builder: no table found, or table invalid in ' . $daoClassName);
		}
		$variables = "\n";
		foreach ($structure as $fieldName => $fieldDetails) {
			$variables .= "\t" . 'public $' . $fieldName . ";\n";
		}
		if (strpos($recordCode, $variables) !== false) {
			echo 'RECORD completed.';
			return;
		}
		if (strpos($recordCode, 'public $')) {
			throw new Exception('RECORD fields invalid');
			return;
		}
		$recordCode = preg_replace('/(class [a-zA-Z0-9_]+ extends [a-zA-Z0-9_]+\s\{?\n?)/', '$1' . $variables, $recordCode);
		file_put_contents($path, $recordCode);
	}

	protected static function _updateQueryField($tableName) {
		$pathPrefix = self::_getPathPrefixByTableName($tableName);
		$classPrefix = self::_getClassNamePrefixByTableName($tableName);
		$className = $classPrefix . '_Query_Field';
		$queryClassName = $classPrefix . '_Query';
		$path = $pathPrefix . '/Query/Field.php';
		self::_mkdirRecursive($path);
		$queryCode = '<?php' . "\n\n" .
			'/**' . "\n" .
			' * @method ' . $queryClassName . ' equals() equals($value)' . "\n" .
			' * @method ' . $queryClassName . ' notEquals() notEquals($value)' . "\n" .
			' * @method ' . $queryClassName . ' greater() greater($value)' . "\n" .
			' * @method ' . $queryClassName . ' less() less($value)' . "\n" .
			' * @method ' . $queryClassName . ' greaterOrEquals() greaterOrEquals($value)' . "\n" .
			' * @method ' . $queryClassName . ' lessOrEquals() lessOrEquals($value)' . "\n" .
			' * @method ' . $queryClassName . ' like() like($value)' . "\n" .
			' * @method ' . $queryClassName . ' ilike() ilike($value)' . "\n" .
			' */' . "\n" .
			'class ' .
			$className .
			' extends Mmi_Dao_Query_Field {' .
			"\n\n" .
			'}';
		file_put_contents($path, $queryCode);
	}

	protected static function _updateQueryJoin($tableName) {
		$pathPrefix = self::_getPathPrefixByTableName($tableName);
		$classPrefix = self::_getClassNamePrefixByTableName($tableName);
		$className = $classPrefix . '_Query_Join';
		$queryClassName = $classPrefix . '_Query';
		$path = $pathPrefix . '/Query/Join.php';
		self::_mkdirRecursive($path);
		$queryCode = '<?php' . "\n\n" .
			'/**' . "\n" .
			' * @method ' . $queryClassName . ' on() on($localKeyName, $joinedKeyName = \'id\')' . "\n" .
			' */' . "\n" .
			'class ' .
			$className .
			' extends Mmi_Dao_Query_Join {' .
			"\n\n" .
			'}';
		file_put_contents($path, $queryCode);
	}

	/**
	 * Tworzy, lub aktualizuje zapytanie
	 * @param string $tableName
	 */
	protected static function _updateQuery($tableName) {
		$pathPrefix = self::_getPathPrefixByTableName($tableName);
		$classPrefix = self::_getClassNamePrefixByTableName($tableName);
		$className = $classPrefix . '_Query';
		$daoClassName = $classPrefix . '_Dao';
		$path = $pathPrefix . '/Query.php';
		$queryCode = '<?php' . "\n\n" .
			'/**' . "\n" .
			' * @method ' . $className . ' limit() limit($limit = null)' . "\n" .
			' * @method ' . $className . ' offset() offset($offset = null)' . "\n" .
			' * @method ' . $className . ' orderAsc() orderAsc($fieldName, $tableName = null)' . "\n" .
			' * @method ' . $className . ' orderDesc() orderDesc($fieldName, $tableName = null)' . "\n" .
			' * @method ' . $className . ' andQuery() andQuery(Mmi_Dao_Query $query)' . "\n" .
			' * @method ' . $className . ' whereQuery() whereQuery(Mmi_Dao_Query $query)' . "\n" .
			' * @method ' . $className . ' orQuery() orQuery(Mmi_Dao_Query $query)' . "\n" .
			' * @method ' . $className . ' andField() andField($fieldName, $tableName = null)' . "\n" .
			' * @method ' . $className . ' where() where($fieldName, $tableName = null)' . "\n" .
			' * @method ' . $className . ' orField() orField($fieldName, $tableName = null)' . "\n" .
			' * @method ' . $className . ' resetOrder() resetOrder()' . "\n" .
			' * @method ' . $className . ' resetWhere() resetWhere()' . "\n" .
			' */' . "\n" .
			'class ' .
			$className .
			' extends Mmi_Dao_Query {' .
			"\n\n" .
			'}';
		$methods = '';
		$structure = $daoClassName::getTableStructure();
		if (empty($structure)) {
			throw new Exception('Mmi_Dao_Builder: no table found, or table invalid in ' . $daoClassName);
		}
		foreach ($structure as $fieldName => $fieldDetails) {
			$methods .= self::_queryMethod('where', $fieldName, $tableName);
			$methods .= self::_queryMethod('andField', $fieldName, $tableName);
			$methods .= self::_queryMethod('orField', $fieldName, $tableName);
			$methods .= self::_queryMethod('orderAsc', $fieldName, $tableName);
			$methods .= self::_queryMethod('orderDesc', $fieldName, $tableName);
		}
		$methods .= self::_queryJoinMethod($tableName);
		$queryCode = preg_replace('/(class [a-zA-Z0-9_]+ extends [a-zA-Z0-9_]+\s\{?\n?)/', '$1' . $methods, $queryCode);
		file_put_contents($path, $queryCode);
	}

	protected static function _queryMethod($prefix, $fieldName, $tableName) {
		$fieldClass = self::_getClassNamePrefixByTableName($tableName) . '_Query_Field';
		return "\n\t" . '/**' . "\n" .
			"\t" . ' * @return ' . $fieldClass . "\n" .
			"\t" . ' */' . "\n" .
			"\t" . 'public function ' . $prefix . ucfirst($fieldName) . "() {\n"
			. "\t\t" . 'return $this->' .  $prefix . '(\'' . $fieldName . '\');' . "\n"
			. "\t}\n";
	}

	protected static function _queryJoinMethod($tableName) {
		$joinClass = self::_getClassNamePrefixByTableName($tableName) . '_Query_Join';
		return "\n\t" . '/**' . "\n" .
			"\t" . ' * @param string $tableName nazwa tabeli' . "\n" .
			"\t" . ' * @param string $targetTableName opcjonalnie nazwa tabeli do której łączyć' . "\n" .
			"\t" . ' * @return ' . $joinClass . "\n" .
			"\t" . ' */' . "\n" .
			"\t" . 'public function join($tableName, $targetTableName = null)' . " {\n"
			. "\t\t" . 'return parent::join($tableName, $targetTableName);' . "\n"
			. "\t}\n\n" .
			"\t" . '/**' . "\n" .
			"\t" . ' * @param string $tableName nazwa tabeli' . "\n" .
			"\t" . ' * @param string $targetTableName opcjonalnie nazwa tabeli do której łączyć' . "\n" .
			"\t" . ' * @return ' . $joinClass . "\n" .
			"\t" . ' */' . "\n" .
			"\t" . 'public function joinLeft($tableName, $targetTableName = null)' . " {\n"
			. "\t\t" . 'return parent::joinLeft($tableName, $targetTableName);' . "\n"
			. "\t}\n";
	}

	/**
	 * Pobiera prefix ścieżki po nazwie tabeli
	 * @param string $tableName
	 * @return string
	 * @throws Exception
	 */
	protected static function _getPathPrefixByTableName($tableName) {
		$table = explode('_', $tableName);
		if (!isset($table[0])) {
			throw new Exception('Mmi_Dao_Builder: invalid table name');
		}
		$baseDir = APPLICATION_PATH . '/modules/' . ucfirst($table[0]) . '/Model/';
		unset($table[0]);
		foreach ($table as $subFolder) {
			$baseDir .= ucfirst($subFolder) . '/';
		}
		return rtrim($baseDir, '/');
	}

	/**
	 * Pobiera prefix klasy obiektu
	 * @param string $tableName
	 * @return string
	 * @throws Exception
	 */
	protected static function _getClassNamePrefixByTableName($tableName) {
		$table = explode('_', $tableName);
		if (!isset($table[0])) {
			throw new Exception('Mmi_Dao_Builder: invalid table name');
		}
		$className = ucfirst($table[0]) . '_Model_';
		unset($table[0]);
		foreach ($table as $subFolder) {
			$className .= ucfirst($subFolder) . '_';
		}
		return rtrim($className, '_');
	}

	/**
	 * Konwertuje bazodanowe nazwy zmiennych na nazwy php
	 * @param string $dbDataType typ danych
	 * @return string
	 */
	protected static function _convertDataType($dbDataType) {
		switch (strtolower($dbDataType)) {
			case 'bool':
			case 'boolean':
				return 'boolean';
			case 'integer':
			case 'int':
			case 'int64':
			case 'tinyint':
			case 'smallint':
			case 'bigint':
			case 'bigserial':
				return 'integer';
			case 'real':
			case 'double precision':
			case 'double':
			case 'float':
				return 'float';
		}
		return 'string';
	}

	protected static function _mkdirRecursive($path) {
		$dirPath = dirname($path);
		$dirs = explode('/', $dirPath);
		$currentDir = '';
		foreach ($dirs as $dir) {
			$currentDir .= $dir . '/';
			if (file_exists($currentDir)) {
				continue;
			}
			mkdir($currentDir);
		}
	}

}
