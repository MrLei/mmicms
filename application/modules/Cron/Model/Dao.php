<?php

class Cron_Model_Dao extends Mmi_Dao {

	protected static $_tableName = 'cron';

	public static function findActive() {
		$q = self::newQuery()
			->where('active')->eqals(1)
			->orderAsc('id');
		return self::find($q);
	}

}
