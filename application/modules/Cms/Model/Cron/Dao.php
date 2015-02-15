<?php

class Cms_Model_Cron_Dao extends Mmi_Dao {

	protected static $_tableName = 'cron';

	public static function activeQuery() {
		return Cms_Model_Cron_Query::factory()
			->whereActive()->equals(1)
			->orderAscId();
	}

}
