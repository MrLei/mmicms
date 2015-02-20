<?php

class Cms_Model_Stat_Label_Dao extends Mmi_Dao {

	public static $_tableName = 'cms_stat_label';

	/**
	 * 
	 * @param string $object
	 * @return Cms_Model_Stat_Label_Query
	 */
	public static function byObjectQuery($object) {
		return Cms_Model_Stat_Label_Query::factory()
				->whereObject()->equals($object);
	}

}
