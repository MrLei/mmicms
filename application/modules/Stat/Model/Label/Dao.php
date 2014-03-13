<?php

class Stat_Model_Label_Dao extends Mmi_Dao {

	public static $_tableName = 'stat_label';

	public static function findFirstByObject($object) {
		$q = self::newQuery()
				->where('object')->equals($object);
		return self::findFirst($q);
	}

}
