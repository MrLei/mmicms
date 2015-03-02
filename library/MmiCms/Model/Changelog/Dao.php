<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace MmiCms\Model\Changelog;

class Dao extends \Mmi\Dao {

	protected static $_tableName = 'DB_CHANGELOG';

	/**
	 * 
	 * @param string $filename
	 * @return MmiCms\Model\Changelog\Query
	 */
	public static function byFilenameQuery($filename) {
		return \Mmi\Dao\Query::factory('MmiCms\Model\Changelog\Dao')
				->where('filename')->equals($filename);
	}

}
