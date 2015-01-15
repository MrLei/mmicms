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

	/**
	 * Aktualizuje konfigurację routera
	 * @param Mmi_Controller_Router_Config $config
	 * @param Mmi_Dao_Record_Collection $routes
	 * @return Mmi_Controller_Router_Config
	 */
	public static function updateRouterConfig(Mmi_Controller_Router_Config $config, Mmi_Dao_Record_Collection $routes) {
		$i = 0;
		foreach ($routes as $route) { /* @var $route Cms_Model_Route_Record */
			$i++;
			$route = $route->toRouteArray();
			$config->setRoute('cms-' . $i, $route['pattern'], $route['replace'], $route['default']);
		}
		return $config;
	}

}
