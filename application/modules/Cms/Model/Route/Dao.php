<?php

namespace Cms\Model\Route;

class Dao extends \Mmi\Dao {

	protected static $_tableName = 'cms_route';

	/**
	 * 
	 * @return \Cms\Model\Route\Query
	 */
	public static function activeQuery() {
		return \Cms\Model\Route\Query::factory()
				->whereActive()->equals(1)
				->orderAscOrder();
	}

	/**
	 * Aktualizuje konfigurację routera
	 * @param \Mmi\Controller\Router\Config $config
	 * @param \Mmi\Dao\Record\Collection $routes
	 * @return \Mmi\Controller\Router\Config
	 */
	public static function updateRouterConfig(\Mmi\Controller\Router\Config $config, \Mmi\Dao\Record\Collection $routes) {
		$i = 0;
		foreach ($routes as $route) { /* @var $route \Cms\Model\Route\Record */
			$i++;
			$route = $route->toRouteArray();
			$config->setRoute('cms-' . $i, $route['pattern'], $route['replace'], $route['default']);
		}
		return $config;
	}

}
