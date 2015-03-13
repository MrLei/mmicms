<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Core\Tools;

//nie ma tu jeszcze autoloadera ładowanie CliAbstract
require_once 'CliAbstract.php';

/**
 * Klasa wdrożeń incrementali bazy danych
 */
class DbDeploy extends CliAbstract {

	/**
	 * Metoda uruchamiająca
	 * @throws \Exception
	 */
	public function run() {

		//pliki incremental
		foreach (glob(APPLICATION_PATH . '/modules/Core/Database/' . \Core\Registry::$config->db->driver . '/incremental/*.sql') as $file) {

			//nazwa pliku
			$baseFileName = basename($file);

			//brak nazwy schematu
			if (strpos($baseFileName, '@') === false) {
				throw new \Exception('Filename ' . $baseFileName . ' invalid: no schema name after "@"');
			}

			//hash pliku
			$md5file = md5_file($file);

			//wyliczanie nazwy schematu bazy danych (dla silników, które tego używają
			$schemaName = substr($baseFileName, strpos($baseFileName, '@') + 1, -4);

			//ustawianie schematu pliku importu i domyślnych parametrów importu
			\Core\Registry::$db->selectSchema($schemaName)
				->setDefaultImportParams();

			//pobranie rekordu
			try {
				$dc = \Core\Model\Changelog\Dao::byFilenameQuery(basename($file))->findFirst();
			} catch (Exception $e) {
				echo 'INITIAL IMPORT.' . "\n";
				$dc = null;
			}

			//restore istnieje md5 zgodne
			if ($dc !== null && $dc->md5 == $md5file) {
				echo 'INCREMENTAL PRESENT: ' . $baseFileName . "\n";
				continue;
			}

			//restore istnieje md5 niezgodne - plik się zmienił - przerwanie importu
			if ($dc !== null) {
				echo 'INVALID MD5: ' . $baseFileName . ' --- VALID: ' . $md5file . " --- IMPORT TERMINATED!\n";
				return;
			}
			//brak restore - zakłada nowy changelog
			$newDc = new \Core\Model\Changelog\Record();

			//import danych
			$result = \Core\Registry::$db->getPdo()->exec(file_get_contents($file));
			if ($result === false) {
				//błąd zapytania
				echo \Core\Registry::$db->getPdo()->errorInfo()[2] . "\n";
				return;
			}

			//tworzenie wpisu
			\Core\Model\Changelog\Dao::resetTableStructures();

			//zapis informacji o incrementalu
			$newDc->filename = $baseFileName;
			$newDc->md5 = $md5file;
			$newDc->save();

			//informacja na ekran
			echo 'RESTORE INCREMENTAL: ' . $baseFileName . "\n";
		}
	}

}

//powołanie obiektu
new DbDeploy();
