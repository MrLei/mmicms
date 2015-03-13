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
 * Klasa budowniczego struktur DAO/Record/Query
 */
class Builder {

	/**
	 * Renderuje DAO, Record i Query dla podanej nazwy tabeli
	 * @param string $tableName
	 * @throws Exception
	 */
	public static function buildFromTableName($tableName) {
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
	 * Tworzy klasę DAO, jeśli istnieje nic nie robi
	 * @param string $tableName
	 */
	protected static function _updateDao($tableName) {
		//prefixy nazw
		$pathPrefix = self::_getPathPrefixByTableName($tableName);
		$classPrefix = self::_getClassNamePrefixByTableName($tableName);
		//ścieżka
		$path = self::_mkdirRecursive($pathPrefix . '/Dao.php');
		//dao tylko z nazwą tabeli
		$daoCode = '<?php' . "\n\n" .
			'namespace ' . $classPrefix . ";\n\n" .
			'class Dao extends \Mmi\Dao {' .
			"\n\n\t" .
			'protected static $_tableName = \'' .
			$tableName . '\';' .
			"\n\n" .
			'}' . "\n";
		//nic nie robi jeśli dao już istnieje
		if (file_exists($path)) {
			return;
		}
		//zapis pliku
		file_put_contents($path, $daoCode);
	}

	/**
	 * Tworzy, lub aktualizuje rekord
	 * @param string $tableName
	 */
	protected static function _updateRecord($tableName) {
		//prefixy nazw
		$pathPrefix = self::_getPathPrefixByTableName($tableName);
		$classPrefix = self::_getClassNamePrefixByTableName($tableName);
		$daoClassName = '\\' . $classPrefix . '\Dao';
		$recordCode = '<?php' . "\n\n" .
			'namespace ' . $classPrefix . ";\n\n" .
			'class Record extends \Mmi\Dao\Record {' .
			"\n\n" .
			'}' . "\n";
		//ścieżka do pliku
		$path = self::_mkdirRecursive($pathPrefix . '/Record.php');
		//wczytanie istniejącego rekordu
		if (file_exists($path)) {
			$recordCode = file_get_contents($path);
		}
		//odczyt struktury tabeli
		$structure = $daoClassName::getTableStructure();
		//błędna struktrura lub brak
		if (empty($structure)) {
			throw new\Exception('\Mmi\Dao\Builder: no table found, or table invalid in ' . $daoClassName);
		}
		$variableString = "\n";
		//generowanie pól rekordu
		foreach ($structure as $fieldName => $fieldDetails) {
			$variables[] = \Mmi\Dao::convertUnderscoreToCamelcase($fieldName);
			$variableString .= "\t" . 'public $' . \Mmi\Dao::convertUnderscoreToCamelcase($fieldName) . ";\n";
		}
		//sprawdzanie istnienia pól rekordu
		if (preg_match_all('/\tpublic \$([a-zA-Z0-9\_]+)[\;|\s\=]/', $recordCode, $codeVariables) && isset($codeVariables[1])) {
			//za dużo względem bazy
			$diffRecord = array_diff($codeVariables[1], $variables);
			//brakujące względem DB
			$diffDb = array_diff($variables, $codeVariables[1]);
			//pola się nie zgadzają
			if (!empty($diffRecord) || !empty($diffDb)) {
				throw new \Exception('RECORD for: "' . $tableName . '" has invalid fields: ' . implode(', ', $diffRecord) . ', and missing: ' . implode(',', $diffDb));
			}
			return;
		}
		$recordCode = preg_replace('/(class Record extends [\\a-zA-Z0-9]+\s\{?\r?\n?)/', '$1' . $variableString, $recordCode);
		//zapis pliku
		file_put_contents($path, $recordCode);
	}

	/**
	 * Tworzy lub aktualizuje pole query
	 * @param string $tableName
	 */
	protected static function _updateQueryField($tableName) {
		//prefixy nazw
		$pathPrefix = self::_getPathPrefixByTableName($tableName);
		$classPrefix = self::_getClassNamePrefixByTableName($tableName);
		$queryClassName = $classPrefix . '\Query';
		//anotacje dla metod porównujących (equals itp.)
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
		//zapis pliku
		file_put_contents(self::_mkdirRecursive($pathPrefix . '/Query/Field.php'), $queryCode);
	}

	/**
	 * Tworzy lub aktualizuje obiekt złączenia (JOIN)
	 * @param string $tableName
	 */
	protected static function _updateQueryJoin($tableName) {
		//prefixy nazw
		$pathPrefix = self::_getPathPrefixByTableName($tableName);
		$classPrefix = self::_getClassNamePrefixByTableName($tableName);
		$queryClassName = $classPrefix . '\Query';
		//anotacja dla metody on()
		$queryCode = '<?php' . "\n\n" .
			'namespace ' . $classPrefix . '\Query' . ";\n\n" .
			'/**' . "\n" .
			' * @method \\' . $queryClassName . ' on($localKeyName, $joinedKeyName = \'id\')' . "\n" .
			' */' . "\n" .
			'class Join extends \Mmi\Dao\Query\Join {' .
			"\n\n" .
			'}' . "\n";
		//zapis pliku
		file_put_contents(self::_mkdirRecursive($pathPrefix . '/Query/Join.php'), $queryCode);
	}

	/**
	 * Tworzy, lub aktualizuje zapytanie
	 * @param string $tableName
	 */
	protected static function _updateQuery($tableName) {
		//prefixy nazw
		$pathPrefix = self::_getPathPrefixByTableName($tableName);
		$classPrefix = self::_getClassNamePrefixByTableName($tableName);
		//nazwa klasy
		$className = $classPrefix . '\Query';
		//nazwa klasy pola
		$fieldClassName = $classPrefix . '\Query\Field';
		//nazwa klasy złączenia
		$joinClassName = $classPrefix . '\Query\Join';
		//nazwa rekordu
		$recordClassName = $classPrefix . '\Record';
		//nazwa DAO
		$daoClassName = '\\' . $classPrefix . '\Dao';
		
		//ścieżka
		$path = $pathPrefix . '/Query.php';
		self::_mkdirRecursive($path);
		
		//odczyt struktury
		$structure = $daoClassName::getTableStructure();
		//pusta, lub błędna struktura
		if (empty($structure)) {
			throw new \Exception('\Mmi\Dao\Builder: no table ' . $tableName . ' found, or table invalid in ' . $daoClassName);
		}
		
		$methods = '';
		//budowanie komentarzy do metod
		foreach ($structure as $fieldName => $fieldDetails) {
			$fieldName = ucfirst(\Mmi\Dao::convertUnderscoreToCamelcase($fieldName));
			//metody where... np. whereActive()
			$methods .= ' * @method \\' . $fieldClassName . ' where' . $fieldName . '()' . "\n";
			//metody andField... np. andFieldActive()
			$methods .= ' * @method \\' . $fieldClassName . ' andField' . $fieldName . '()' . "\n";
			//orField
			$methods .= ' * @method \\' . $fieldClassName . ' orField' . $fieldName . '()' . "\n";
			//orderAsc
			$methods .= ' * @method \\' . $fieldClassName . ' orderAsc' . $fieldName . '()' . "\n";
			//orderDesc
			$methods .= ' * @method \\' . $fieldClassName . ' orderDesc' . $fieldName . '()' . "\n";
		}
		//łączenie anotacji stałych dla klasy z anotacjami __call dla pól
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
		//klasy leżą w plikach w /Model/
		$baseDir = APPLICATION_PATH . '/modules/' . ucfirst($table[0]) . '/Model/';
		unset($table[0]);
		//dodawanie kolejnych zagłębień
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
		//klasy leżą w namespace'ach Model w modułach
		$className = ucfirst($table[0]) . '\\Model\\';
		unset($table[0]);
		//dodawanie kolejnych zagłębień
		foreach ($table as $subFolder) {
			$className .= ucfirst($subFolder) . '\\';
		}
		return rtrim($className, '\\');
	}

	/**
	 * Tworzy rekurencyjnie strukturę
	 * @param string $path
	 * @return string ścieżka wejściowa
	 */
	protected static function _mkdirRecursive($path) {
		//ekstrakcja nazwy katalogu
		$dirPath = dirname($path);
		$dirs = explode('/', $dirPath);
		$currentDir = '';
		//tworzenie katalogów po kolei
		foreach ($dirs as $dir) {
			$currentDir .= $dir . '/';
			if (file_exists($currentDir)) {
				continue;
			}
			mkdir($currentDir);
		}
		return $path;
	}

}
