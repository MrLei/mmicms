<?php

class Cron_Model_Dao extends Mmi_Dao {

	protected static $_tableName = 'cron';

	public static function activeQuery() {
		return Cron_Model_Query::factory()
			->whereActive()->equals(1)
			->orderAscId();
	}

}
