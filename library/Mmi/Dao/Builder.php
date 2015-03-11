<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Mmi\Dao;

class Builder {

	/**
	 * Przebudowuje wszystkie Dao, Record i Query
	 */
	public static function rebuildAll() {
		foreach (\Core\Registry::$db->tableList(\Core\Registry::$config->db->schema) as $tableName) {
			self::buildFromTableName($tableName);
		}
	}

	/**
	 * Renderuje DAO, Record i Query dla podanej nazwy tabeli
	 * @param string $tableName
	 * @throws Exception
	 */
	public static function buildFromTableName($tableName) {
		//jeśli DB_CHANGELOG nie tworzy obiektów
		if ($tableName == 'DB_CHANGELOG') {
			return;
		}
		//aktualizacja DAO
		self::_updateDao($tableName);
		//aktualizacja QUERY-FIELD
		self::_updateQueryField($tableName);
		//aktualizacja QUERY-JOIN
		self::_updateQueryJoin($tableName);
		//aktualizacja QUERY
		self::_updateQuery($tableName);
		//aktualizacja RECORD
		self::_updateRecord($tableName);
	}

	/**
	 * Tworzy lub aktualizuje klasę DAO
	 * @param string $tableName
	 */
	protected static function _updateDao($tableName) {
		$pathPrefix = self::_getPathPrefixByTableName($tableName);
		$classPrefix = self::_getClassNamePrefixByTableName($tableName);
		$path = $pathPrefix . '/Dao.php';
		self::_mkdirRecursive($path);
		$daoCode = '<?php' . "\n\n" .
			'namespace ' . $classPrefix . ";\n\n" .
			'class Dao extends \Mmi\Dao {' .
			"\n\n\t" .
			'protected static $_tableName = \'' .
			$tableName . '\';' .
			"\n\n" .
			'}' . "\n";
		if (file_exists($path)) {
			echo 'DAO completed.';
			return;
		}
		file_put_contents($path, $daoCode);
	}

	/**
	 * Tworzy, lub aktualizuje rekord
	 * @param string $tableName
	 */
	protected static function _updateRecord($tableName) {
		$pathPrefix = self::_getPathPrefixByTableName($tableName);
		$classPrefix = self::_getClassNamePrefixByTableName($tableName);
		$daoClassName = '\\' . $classPrefix . '\Dao';
		$path = $pathPrefix . '/Record.php';
		self::_mkdirRecursive($path);
		$recordCode = '<?php' . "\n\n" .
			'namespace ' . $classPrefix . ";\n\n" .
			'class Record extends \Mmi\Dao\Record {' .
			"\n\n" .
			'}' . "\n";
		if (file_exists($path)) {
			$recordCode = file_get_contents($path);
		}
		$structure = $daoClassName::getTableStructure();
		if (empty($structure)) {
			throw new\Exception('\Mmi\Dao\Builder: no table found, or table invalid in ' . $daoClassName);
		}
		$variableString = "\n";
		foreach ($structure as $fieldName => $fieldDetails) {
			$variables[] = \Mmi\Dao::convertUnderscoreToCamelcase($fieldName);
			$variableString .= "\t" . 'public $' . \Mmi\Dao::convertUnderscoreToCamelcase($fieldName) . ";\n";
		}
		if (preg_match_all('/\tpublic \$([a-zA-Z0-9\_]+)[\;|\s\=]/', $recordCode, $codeVariables) && isset($codeVariables[1])) {
			$diffRecord = array_diff($codeVariables[1], $variables);
			$diffDb = array_diff($variables, $codeVariables[1]);
			if (!empty($diffRecord) || !empty($diffDb)) {
				throw new \Exception('RECORD for: "' . $tableName . '" has invalid fields: ' . implode(', ', $diffRecord) . ', and missing: ' . implode(',', $diffDb));
			}
			echo 'RECORD for: ' . $tableName . ' completed.';
			return;
		}
		$recordCode = preg_replace('/(class Record extends [\\a-zA-Z0-9]+\s\{?\r?\n?)/', '$1' . $variableString, $recordCode);
		file_put_contents($path, $recordCode);
	}

	/**
	 * Tworzy lub aktualizuje pole query
	 * @param string $tableName
	 */
	protected static function _updateQueryField($tableName) {
		$pathPrefix = self::_getPathPrefixByTableName($tableName);
		$classPrefix = self::_getClassNamePrefixByTableName($tableName);
		$queryClassName = $classPrefix . '\Query';
		$path = $pathPrefix . '/Query/Field.php';
		self::_mkdirRecursive($path);
		$queryCode = '<?php' . "\n\n" .
			'namespace ' . $classPrefix . '\Query' . ";\n\n" .
			'/**' . "\n" .
			' * @method \\' . $queryClassName . ' equals($value)' . "\n" .
			' * @method \\' . $queryClassName . ' notEquals($value)' . "\n" .
			' * @method \\' . $queryClassName . ' greater($value)' . "\n" .
			' * @method \\' . $queryClassName . ' less($value)' . "\n" .
			' * @method \\' . $queryClassName . ' greaterOrEquals($value)' . "\n" .
			' * @method \\' . $queryClassName . ' lessOrEquals($value)' . "\n" .
			' * @method \\' . $queryClassName . ' like($value)' . "\n" .
			' * @method \\' . $queryClassName . ' ilike($value)' . "\n" .
			' */' . "\n" .
			'class Field extends \Mmi\Dao\Query\Field {' .
			"\n\n" .
			'}' . "\n";
		file_put_contents($path, $queryCode);
	}

	/**
	 * Tworzy lub aktualizuje obiekt złączenia (JOIN)
	 * @param string $tableName
	 */
	protected static function _updateQueryJoin($tableName) {
		$pathPrefix = self::_getPathPrefixByTableName($tableName);
		$classPrefix = self::_getClassNamePrefixByTableName($tableName);
		$queryClassName = $classPrefix . '\Query';
		$path = $pathPrefix . '/Query/Join.php';
		self::_mkdirRecursive($path);
		$queryCode = '<?php' . "\n\n" .
			'namespace ' . $classPrefix . '\Query' . ";\n\n" .
			'/**' . "\n" .
			' * @method \\' . $queryClassName . ' on($localKeyName, $joinedKeyName = \'id\')' . "\n" .
			' */' . "\n" .
			'class Join extends \Mmi\Dao\Query\Join {' .
			"\n\n" .
			'}' . "\n";
		file_put_contents($path, $queryCode);
	}

	/**
	 * Tworzy, lub aktualizuje zapytanie
	 * @param string $tableName
	 */
	protected static function _updateQuery($tableName) {
		$pathPrefix = self::_getPathPrefixByTableName($tableName);
		$classPrefix = self::_getClassNamePrefixByTableName($tableName);
		$className = $classPrefix . '\Query';
		$fieldClassName = $classPrefix . '\Query\Field';
		$joinClassName = $classPrefix . '\Query\Join';
		$recordClassName = $classPrefix . '\Record';
		$daoClassName = '\\' . $classPrefix . '\Dao';
		$path = $pathPrefix . '/Query.php';
		//odczyt struktury
		$structure = $daoClassName::getTableStructure();
		if (empty($structure)) {
			throw new \Exception('\Mmi\Dao\Builder: no table ' . $tableName . ' found, or table invalid in ' . $daoClassName);
		}
		
		$methods = '';
		//budowanie komentarzy do metod
		foreach ($structure as $fieldName => $fieldDetails) {
			$fieldName = ucfirst(\Mmi\Dao::convertUnderscoreToCamelcase($fieldName));
			$methods .= ' * @method \\' . $fieldClassName . ' where' . $fieldName . '()' . "\n";
			$methods .= ' * @method \\' . $fieldClassName . ' andField' . $fieldName . '()' . "\n";
			$methods .= ' * @method \\' . $fieldClassName . ' orField' . $fieldName . '()' . "\n";
			$methods .= ' * @method \\' . $fieldClassName . ' orderAsc' . $fieldName . '()' . "\n";
			$methods .= ' * @method \\' . $fieldClassName . ' orderDesc' . $fieldName . '()' . "\n";
		}

		$queryCode = '<?php' . "\n\n" .
			'namespace ' . $classPrefix . ";\n\n" .
			'/**' . "\n" .
			' * @method \\' . $className . ' limit($limit = null)' . "\n" .
			' * @method \\' . $className . ' offset($offset = null)' . "\n" .
			' * @method \\' . $className . ' orderAsc($fieldName, $tableName = null)' . "\n" .
			' * @method \\' . $className . ' orderDesc($fieldName, $tableName = null)' . "\n" .
			' * @method \\' . $className . ' andQuery(\Mmi\Dao\Query $query)' . "\n" .
			' * @method \\' . $className . ' whereQuery(\Mmi\Dao\Query $query)' . "\n" .
			' * @method \\' . $className . ' orQuery(\Mmi\Dao\Query $query)' . "\n" .
			' * @method \\' . $className . ' resetOrder()' . "\n" .
			' * @method \\' . $className . ' resetWhere()' . "\n" .
			$methods .
			' * @method \\' . $fieldClassName . ' andField($fieldName, $tableName = null)' . "\n" .
			' * @method \\' . $fieldClassName . ' where($fieldName, $tableName = null)' . "\n" .
			' * @method \\' . $fieldClassName . ' orField($fieldName, $tableName = null)' . "\n" .
			' * @method \\' . $joinClassName . ' join($tableName, $targetTableName = null)' . "\n" .
			' * @method \\' . $joinClassName . ' joinLeft($tableName, $targetTableName = null)' . "\n" .
			' * @method \\' . $recordClassName . '[] find()' . "\n" .
			' * @method \\' . $recordClassName . ' findFirst()' . "\n" .
			' * @method \\' . $recordClassName . ' findPk($value)' . "\n" .
			' */' . "\n" .
			'class Query extends \Mmi\Dao\Query {' .
			"\n\n"
			. "\t" . '/**' . "\n"
			. "\t" . ' * @return \\' . $className . "\n"
			. "\t" . ' */' . "\n"
			. "\t" . 'public static function factory($daoClassName = null)' . " {\n"
			. "\t\t" . 'return new self($daoClassName);' . "\n"
			. "\t}\n\n}\n";
		file_put_contents($path, $queryCode);
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
			throw new\Exception('\Mmi\Dao\Builder: invalid table name');
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
			throw new\Exception('\Mmi\Dao\Builder: invalid table name');
		}
		$className = ucfirst($table[0]) . '\\Model\\';
		unset($table[0]);
		foreach ($table as $subFolder) {
			$className .= ucfirst($subFolder) . '\\';
		}
		return rtrim($className, '\\');
	}

	/**
	 * Tworzy rekurencyjnie strukturę
	 * @param string $path
	 */
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
