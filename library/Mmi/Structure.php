<?php

/**
 * Mmi
 *
 * LICENSE
 *
 * Ten plik źródłowy objęty jest licencją BSD bez klauzuli ogłoszeniowej.
 * Licencja jest dostępna pod adresem: http://milejko.com/new-bsd.txt
 * W przypadku problemów, prosimy o kontakt na adres mariusz@milejko.pl
 *
 * Mmi/Controller/Front/Structure.php
 * @category   Mmi
 * @package    Mmi_Controller
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    1.0.0
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

/**
 * Builder struktury aplikacji
 * @category   Mmi
 * @package    Mmi_Structure
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */
class Mmi_Structure {

	/**
	 * Zwraca dostępne komponenty aplikacji
	 * @return type 
	 */
	public static function getStructure() {
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
			$moduleName = substr($module, strrpos($module, '/') + 1);
			$moduleName[0] = strtolower($moduleName[0]);
			foreach (($glob = glob($module . '/Controller/Helper/*.php')) ? $glob : [] as $helper) {
				$helperName = substr($helper, strrpos($helper, '/') + 1, -4);
				$components[$moduleName]['Controller']['Helper'][$helperName] = 1;
			}
			foreach (($glob = glob($module . '/View/Helper/*.php')) ? $glob : [] as $helper) {
				$helperName = substr($helper, strrpos($helper, '/') + 1, -4);
				$components[$moduleName]['View']['Helper'][$helperName] = 1;
			}
			foreach (($glob = glob($module . '/Filter/*.php')) ? $glob : [] as $filter) {
				$filterName = substr($filter, strrpos($filter, '/') + 1, -4);
				$components[$moduleName]['Filter'][$filterName] = 1;
			}
			foreach (($glob = glob($module . '/Validate/*.php')) ? $glob : [] as $validator) {
				$validatorName = substr($validator, strrpos($validator, '/') + 1, -4);
				$components[$moduleName]['Validate'][$validatorName] = 1;
			}
			foreach (($glob = glob($module . '/Controller/*.php')) ? $glob : [] as $controller) {
				$controllerName = substr($controller, strrpos($controller, '/') + 1, -4);
				$controllerName[0] = strtolower($controllerName[0]);
				$controllerContent = file_get_contents($controller);
				if (preg_match_all('/function ([a-zA-Z0-9]+Action)\(/', $controllerContent, $actions) && isset($actions[1])) {
					foreach ($actions[1] as $action) {
						$action = substr($action, 0, -6);
						$components[$moduleName][$controllerName][$action] = 1;
					}
				} else {
					$components[$moduleName][$controllerName] = 1;
				}
			}
		}
		return $components;
	}

	/**
	 * Zwraca dostępne layouty i templaty w skórach
	 * @return array
	 */
	private static function _skinStructure() {
		$components = array();
		foreach (($glob = glob(APPLICATION_PATH . '/skins/*')) ? $glob : [] as $skin) {
			$skinName = substr($skin, strrpos($skin, '/') + 1);
			foreach (($glob = glob($skin . '/*')) ? $glob : [] as $module) {
				$moduleName = substr($module, strrpos($module, '/') + 1);
				if (file_exists($module . '/scripts/layout.tpl')) {
					$components[$skinName][$moduleName]['layout'] = 1;
				}
				foreach (($glob = glob($module . '/scripts/*')) ? $glob : [] as $script) {
					$scriptName = substr($script, strrpos($script, '/') + 1);
					if (file_exists($script . '/layout.tpl')) {
						$components[$skinName][$moduleName][$scriptName]['layout'] = 1;
					}
					foreach (($glob = glob($script . '/*')) ? $glob : [] as $action) {
						if ($action == 'layout.tpl') {
							$components[$skinName][$moduleName][$scriptName]['layout'] = 1;
						} else {
							$actionName = substr($action, strrpos($action, '/') + 1);
							$actionName = substr($actionName, 0, strrpos($actionName, '.'));
							$components[$skinName][$moduleName][$scriptName][$actionName] = 1;
						}
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
		foreach (($glob = glob(LIB_PATH . '/*')) ? $glob : [] as $lib) {
			$libName = substr($lib, strrpos($lib, '/') + 1);
			if ($libName == 'Zend') {
				continue;
			}
			foreach (($glob = glob($lib . '/View/Helper/*.php')) ? $glob : [] as $helper) {
				$helperName = substr($helper, strrpos($helper, '/') + 1, -4);
				if ($helperName == 'Abstract') {
					continue;
				}
				$components[$libName]['View']['Helper'][$helperName] = 1;
			}
			foreach (($glob = glob($lib . '/Filter/*.php')) ? $glob : [] as $filter) {
				$filterName = substr($filter, strrpos($filter, '/') + 1, -4);
				if ($filterName == 'Abstract') {
					continue;
				}
				$components[$libName]['Filter'][$filterName] = 1;
			}
			foreach (($glob = glob($lib . '/Validate/*.php')) ? $glob : [] as $validator) {
				$validatorName = substr($validator, strrpos($validator, '/') + 1, -4);
				if ($validatorName == 'Abstract') {
					continue;
				}
				$components[$libName]['Validate'][$validatorName] = 1;
			}
		}
		return $components;
	}

}
