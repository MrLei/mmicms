<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Core\Model\Changelog;

/**
 * DAO dla loga używanego przy wdrożeniach incrementali bazy danych
 */
class Dao extends \Mmi\Dao {

	protected static $_tableName = 'DB_CHANGELOG';

	/**
	 * Zapytanie szukające po nazwie pliku
	 * @param string $filename
	 * @return \Mmi\Dao\Query
	 */
	public static function byFilenameQuery($filename) {
		return \Mmi\Dao\Query::factory('Cms\Model\Changelog\Dao')
				->whereFilename()->equals($filename);
	}

}
