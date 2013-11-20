<?php

class Stat_Model_Label_Dao extends Mmi_Dao {

	public static $_tableName = 'stat_label';

	public static function findFirstByObject($object) {
		$q = self::newQuery()
				->where('object')->eqals($object);
		return self::findFirst($q);
	}

}
