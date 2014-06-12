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
	 * Zapisuje annotację w kodzie klasy rekordu
	 * @param Mmi_Dao_Record_Ro $record
	 * @throws Exception
	 */
	public static function annotateRecord(Mmi_Dao_Record_Ro $record) {
		$recordClass = get_class($record);
		$pathValues = explode('_', $recordClass);
		$dao = $record->getDaoClassName();
		$recordFileName = APPLICATION_PATH . '/modules/' . implode('/', $pathValues) . '.php';
		$recordFile = file_get_contents($recordFileName);
		if (strpos($recordFile, '@property') !== false) {
			throw new Exception('Mmi_Dao_Builder: annotation present in ' . $recordFileName);
		}
		$annotation = '/**' . "\n";
		$structure = $dao::getTableStructure();
		if (empty($structure)) {
			throw new Exception('Mmi_Dao_Builder: no table found, or table invalid in ' . $dao);
		}
		foreach ($structure as $fieldName => $fieldDetails) {
			$annotation .= ' * @property ' . self::_convertDataType($fieldDetails['dataType']) . ' $' . $fieldName . "\n";
		}
		$annotation .= ' */' . "\r\n";
		file_put_contents($recordFileName, str_replace('class ' . $recordClass, $annotation . 'class ' . $recordClass, $recordFile));
	}

	/**
	 * Renderuje DAO i Record dla podanej nazwy tabeli
	 * @param type $tableName
	 * @throws Exception
	 */
	public static function renderDaoRecord($tableName) {
		$table = explode('_', $tableName);
		if (!isset($table[0])) {
			throw new Exception('Mmi_Dao_Builder: invalid table name');
		}
		$baseDir = APPLICATION_PATH . '/modules/' . ucfirst($table[0]) . '/Model/';
		$className = ucfirst($table[0]) . '_Model_';
		if (!file_exists(APPLICATION_PATH . '/modules/' . ucfirst($table[0]))) {
			mkdir(rtrim(APPLICATION_PATH . '/modules/' . ucfirst($table[0]), '/'));
		}
		if (!file_exists($baseDir)) {
			mkdir(rtrim($baseDir, '/'));
		}
		unset($table[0]);
		foreach ($table as $subFolder) {
			$baseDir .= ucfirst($subFolder) . '/';
			$className .= ucfirst($subFolder) . '_';
			if (!file_exists($baseDir)) {
				mkdir(rtrim($baseDir, '/'));
			}
		}

		$daoFileName = $baseDir . 'Dao.php';
		$recordFileName = $baseDir . 'Record.php';
		$daoClassName = $className . 'Dao';
		$recordClassName = $className . 'Record';

		if (file_exists($daoFileName)) {
			throw new Exception('Mmi_Dao_Builder: dao exists ' . $daoClassName);
		}

		if (file_exists($recordFileName)) {
			throw new Exception('Mmi_Dao_Builder: record exists ' . $recordClassName);
		}

		$daoCode = '<?php' . "\r\n\r\n" .
			'class ' .
			$className . 'Dao' .
			' extends Mmi_Dao {' .
			"\r\n\r\n\t" .
			'protected static $_tableName = \'' .
			$tableName . '\';' .
			"\r\n\r\n" .
			'}';
		file_put_contents($daoFileName, $daoCode);

		$recordCode = '<?php' . "\r\n\r\n" .
			'class ' .
			$recordClassName .
			' extends Mmi_Dao_Record {' .
			"\r\n\r\n" .
			'}';
		file_put_contents($recordFileName, $recordCode);
		try {
			self::annotateRecord(new $recordClassName());
		} catch (Exception $e) {
			unlink($daoFileName);
			unlink($recordFileName);
			throw $e;
		}
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

}
