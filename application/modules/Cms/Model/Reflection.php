<?php

class Cms_Model_Reflection {

	public static function getActions() {
		$structure = array();
		foreach (glob(APPLICATION_PATH . '/modules/*') as $module) {
			$moduleName = substr($module, strrpos($module, '/') + 1);
			foreach (glob($module . '/Controller/*.php') as $controller) {
				$var = file_get_contents($controller);
				$controllerName = substr($controller, strrpos($controller, '/') + 1, -4);
				if (preg_match_all('/function ([a-zA-Z0-9]+Action)\(/', $var, $actions) && isset($actions[1])) {
					foreach ($actions[1] as $action) {
						$action = substr($action, 0, -6);
						$moduleName = strtolower($moduleName);
						$controllerName[0] = strtolower($controllerName[0]);
						$structure[] = array(
							'path' => trim($moduleName . '_' . $controllerName . '_' . $action, '_ '),
							'module' => $moduleName,
							'controller' => $controllerName,
							'action' => $action
						);
					}
				}
			}
		}
		return $structure;
	}

	public static function getOptionsWildcard() {
		$structure = array();
		foreach (glob(APPLICATION_PATH . '/modules/*') as $module) {
			$moduleName = substr($module, strrpos($module, '/') + 1);
			foreach (glob($module . '/Controller/*.php') as $controller) {
				$var = file_get_contents($controller);
				$controllerName = substr($controller, strrpos($controller, '/') + 1, -4);
				if (preg_match_all('/function ([a-zA-Z0-9]+Action)\(/', $var, $actions) && isset($actions[1])) {
					$first = true;
					foreach ($actions[1] as $action) {
						$action = substr($action, 0, -6);
						if ($first) {
							$structure[$moduleName] = $moduleName;
							$structure[$moduleName . ':' . $controllerName] = $moduleName . ' - ' . $controllerName;
							$first = false;
						}
						$structure[$moduleName . ':' . $controllerName . ':' . $action] = $moduleName . ' - ' . $controllerName . ' - ' . $action;
					}
				}
			}
		}
		return $structure;
	}

}
