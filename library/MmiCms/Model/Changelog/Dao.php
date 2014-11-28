<?php

class MmiCms_Model_Changelog_Dao extends Mmi_Dao {

	protected static $_tableName = 'DB_CHANGELOG';
	protected static $_queryName = 'Mmi_Dao_Query';

	public static function findFirstByFilename($filename) {
		$q = self::newQuery()
			->where('filename')->equals($filename);
		return self::findFirst($q);
	}

}
