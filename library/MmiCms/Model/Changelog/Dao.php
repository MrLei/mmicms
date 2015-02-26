<?php

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
