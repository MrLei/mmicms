<?php

class Stat_Model_Label_Dao extends Mmi_Dao {

	public static $_tableName = 'stat_label';

	public static function findFirstByObject($object) {
		return Stat_Model_Label_Query::factory()
				->whereObject()->equals($object)
				->findFirst();
	}

}
