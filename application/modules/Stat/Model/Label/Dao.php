<?php

class Stat_Model_Label_Dao extends Mmi_Dao {

	public static $_tableName = 'stat_label';

	/**
	 * 
	 * @param string $object
	 * @return Stat_Model_Label_Query
	 */
	public static function byObjectQuery($object) {
		return Stat_Model_Label_Query::factory()
				->whereObject()->equals($object);
	}

}
