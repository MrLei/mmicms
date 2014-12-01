<?php

/**
 * @method Cms_Model_Route_Query newQuery() newQuery()
 */
class Cms_Model_Route_Dao extends Mmi_Dao {

	protected static $_tableName = 'cms_route';
	
	/**
	 * 
	 * @return Cms_Model_Route_Query
	 */
	public static function activeQuery() {
		return self::newQuery()
			->where('active')->equals(1)
			->orderAsc('order');
	}

	public static function findActive() {
		$texts = array();
		foreach (self::activeQuery()->find() as $text) {
			$texts[] = $text->toRouteArray();
		}
		return $texts;
	}

}
