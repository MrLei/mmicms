<?php

class MmiCms_Model_Changelog_Dao extends Mmi_Dao {

	protected static $_tableName = 'DB_CHANGELOG';

	/**
	 * 
	 * @param string $filename
	 * @return MmiCms_Model_Changelog_Query
	 */
	public static function byFilenameQuery($filename) {
		return Mmi_Dao_Query::factory('MmiCms_Model_Changelog_Dao')
			->where('filename')->equals($filename);
	}

}
