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
 * Renderer DAO, rekordów, zapytań itd.
 */
class DaoRenderer extends CliAbstract {

	/**
	 * Metoda uruchamiająca
	 */
	public function run() {

		//odbudowanie wszystkich DAO/Record/Query/Field/Join
		foreach (\Core\Registry::$db->tableList(\Core\Registry::$config->db->schema) as $tableName) {
			//bez generowania dla DB_CHANGELOG
			if (strtoupper($tableName) == 'DB_CHANGELOG') {
				continue;
			}
			//buduje struktruę dla tabeli
			\Mmi\Dao\Builder::buildFromTableName($tableName);
			//info na ekran
			echo 'Rendering for: ' . $tableName . "\n";
		}
	}

}

//powołanie obiektu
new DaoRenderer();
