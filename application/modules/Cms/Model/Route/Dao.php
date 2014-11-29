<?php

/**
 * @method Cms_Model_Route_Query newQuery() newQuery()
 */
class Cms_Model_Route_Dao extends Mmi_Dao {

	protected static $_tableName = 'cms_route';

	public static function findActive() {
		$texts = array();
		$q = self::newQuery()
			->where('active')->equals(1)
			->orderAsc('order');
		foreach (self::find($q) as $text) {
			$texts[] = $text->toRouteArray();
		}
		return $texts;
	}

}
