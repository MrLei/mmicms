<?php

class Cron_Model_Dao extends Mmi_Dao {
	
	protected static $_tableName = 'cron';
	
	public static function findActive() {
		$q = self::getNewQuery();
		$q->andField('active')->eqals(1)
				->orderAsc('id');
		return self::find($q);
	}
	
}