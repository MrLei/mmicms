<?php


namespace Cms\Model\Stat\Label;

class Dao extends \Mmi\Dao {

	public static $_tableName = 'cms_stat_label';

	/**
	 * 
	 * @param string $object
	 * @return Cms\Model\Stat\Label\Query
	 */
	public static function byObjectQuery($object) {
		return Cms\Model\Stat\Label\Query::factory()
				->whereObject()->equals($object);
	}

}
