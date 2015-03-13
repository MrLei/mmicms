<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Mmi;

class Structure {

	/**
	 * Zwraca dostępne komponenty aplikacji
	 * @return array 
	 */
	public static function getStructure() {
		//pobranie struktury
		return array(
			'module' => self::_applicationStructure(),
			'skin' => self::_skinStructure(),
			'library' => self::_libraryStructure()
		);
	}

	/**
	 * Zwraca dostępne komponenty aplikacyjne w systemie
	 * @return array
	 */
	private static function _applicationStructure() {
		$components = array();
		foreach (glob(APPLICATION_PATH . '/modules/*') as $module) {
			//nazwa modułu
			$moduleName = lcfirst(substr($module, strrpos($module, '/') + 1));
			foreach (($glob = glob($module . '/Controller/*')) ? $glob : [] as $controller) {
				if (is_dir($controller)) {
					//iteracja po kontrolerach wewnątrz katalogu
					foreach (($glb = glob($controller . '/*.php')) ? $glb : [] as $cnt) {
						$controllerName = lcfirst(substr($cnt, strrpos($cnt, '/') + 1, -4));
						$controllerName = lcfirst(substr($controller, strrpos($controller, '/') + 1)) . '-' . $controllerName;
						//parsuje akcje z kontrolera
						self::_parseActions($components, $cnt, $moduleName, $controllerName);
					}
					continue;
				}
				$controllerName = lcfirst(substr($controller, strrpos($controller, '/') + 1, -4));
				//parsuje akcje z kontrolera
				self::_parseActions($components, $controller, $moduleName, $controllerName);
			}
		}
		return $components;
	}

	/**
	 * Parsowanie akcji w kontrolerze
	 * @param array $components
	 * @param string $controllerPath
	 * @param string $moduleName
	 * @param string $controllerName
	 */
	private static function _parseActions(array &$components, $controllerPath, $moduleName, $controllerName) {
		//łapanie nazw akcji w kodzie
		if (preg_match_all('/function ([a-zA-Z0-9]+Action)\(/', file_get_contents($controllerPath), $actions)) {
			foreach ($actions[1] as $action) {
				$components[$moduleName][$controllerName][substr($action, 0, -6)] = 1;
			}
		}
	}

	/**
	 * Zwraca dostępne layouty i templaty w skórach
	 * @return array
	 */
	private static function _skinStructure() {
		$components = array();
		foreach (($glob = glob(APPLICATION_PATH . '/skins/*')) ? $glob : [] as $skin) {
			//nazwa skóry
			$skinName = substr($skin, strrpos($skin, '/') + 1);
			//iteracja po modułach
			foreach (($glob = glob($skin . '/*')) ? $glob : [] as $module) {
				$moduleName = substr($module, strrpos($module, '/') + 1);
				//layouty w modułach
				if (file_exists($module . '/scripts/layout.tpl')) {
					$components[$skinName][$moduleName]['layout'] = 1;
				}
				foreach (($glob = glob($module . '/scripts/*')) ? $glob : [] as $script) {
					$scriptName = substr($script, strrpos($script, '/') + 1);
					//layouty w kontrolerach
					foreach (($glob = glob($script . '/*')) ? $glob : [] as $action) {
						if (is_dir($action)) {
							foreach (($glb = glob($action . '/*')) ? $glb : [] as $act) {
								//layouty i akcje w podkatalogach
								$actionName = substr($act, strrpos($act, '/') + 1, -4);
								$components[$skinName][$moduleName][$scriptName . '-' . substr($action, strrpos($action, '/') + 1)][$actionName] = 1;
							}
							continue;
						}
						//layouty i akcje
						$actionName = substr($action, strrpos($action, '/') + 1, -4);
						$components[$skinName][$moduleName][$scriptName][$actionName] = 1;
					}
				}
			}
		}
		return $components;
	}

	/**
	 * Zwraca dostępne helpery i filtry w bibliotekach
	 * @return array
	 */
	private static function _libraryStructure() {
		$components = array();
		foreach (($glob = glob(APPLICATION_PATH . '/modules/*')) ? $glob : [] as $lib) {
			//parsowanie helperów widoku
			self::_parseLib($components, $lib, 'View/Helper');
			//parsowanie filtrów
			self::_parseLib($components, $lib, 'Filter');
			//parsowanie walidatorów
			self::_parseLib($components, $lib, 'Validate');
		}
		return $components;
	}

	/**
	 * Parser biblioteki
	 * @param array $components referencja do komponentów
	 * @param string $libPath ścieżka do biblioteki
	 * @param string $path ścieżka do zasobu
	 */
	private static function _parseLib(array &$components, $libPath, $path) {
		$libName = substr($libPath, strrpos($libPath, '/') + 1);
		foreach (($glob = glob($libPath . '/' . $path . '/*.php')) ? $glob : [] as $helper) {
			$helperName = substr($helper, strrpos($helper, '/') + 1, -4);
			$components[$libName][str_replace('/', '', $path)][$helperName] = 1;
		}
	}

}
