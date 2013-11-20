<?php

class MmiCms_Model_Changelog_Dao extends Mmi_Dao {

	protected static $_tableName = 'DB_CHANGELOG';

	public static function findFirstByFilename($filename) {
		$q = self::newQuery()
			->where('filename', $filename);
		return self::findFirst($q);
	}

}
