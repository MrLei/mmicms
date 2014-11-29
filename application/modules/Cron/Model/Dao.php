<?php

/**
 * @method Cron_Model_Query newQuery() newQuery()
 */
class Cron_Model_Dao extends Mmi_Dao {

	protected static $_tableName = 'cron';

	public static function findActive() {
		$q = self::newQuery()
			->where('active')->equals(1)
			->orderAsc('id');
		return self::find($q);
	}

}
