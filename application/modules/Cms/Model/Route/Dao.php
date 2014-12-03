<?php

class Cms_Model_Route_Dao extends Mmi_Dao {

	protected static $_tableName = 'cms_route';
	
	/**
	 * 
	 * @return Cms_Model_Route_Query
	 */
	public static function activeQuery() {
		return Cms_Model_Route_Query::factory()
			->whereActive()->equals(1)
			->orderAscOrder();
	}

	public static function findActive() {
		$routes = array();
		foreach (self::activeQuery()->find() as $route) {
			$routes[] = $route->toRouteArray();
		}
		return $routes;
	}

}
