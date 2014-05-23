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
 * Mmi/Controller/Action/HelperBroker.php
 * @category   Mmi
 * @package    Mmi_Controller
 * @subpackage Helper
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    1.0.0
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

/**
 * Broker helperów kontrolera akcji
 * @category   Mmi
 * @package    Mmi_Controller
 * @subpackage Helper
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */
class Mmi_Controller_Action_HelperBroker {

	/**
	 * Kontroler akcji
	 * @var Mmi_Controller_Action
	 */
	private static $_actionController;
	
	/**
	 * Lista helperów
	 * @var array
	 */
	private static $_helpers = array();

	/**
	 * Konstruktor
	 * @param Mmi_Controller_Action $actionController kontroler akcji
	 */
	public function __construct(Mmi_Controller_Action $actionController) {
		self::$_actionController = $actionController;
		foreach (self::$_helpers as $helper) {
			$helper->setActionController($actionController);
			$helper->init();
		}
	}

	/**
	 * Usuwa helper
	 * @param string $name nazwa klasy helpera
	 */
	public static function removeHelper($name) {
		unset(self::$_helpers[$name]);
	}

	/**
	 * Dodaje helper
	 * @param Mmi_Controller_Action_Helper_Abstract $helper
	 */
	public static function addHelper(Mmi_Controller_Action_Helper_Abstract $helper) {
		self::$_helpers[get_class($helper)] = $helper;
	}
	
	/**
	 * Pobiera helper, jeśli nie jest utworzony, tworzy go i dodaje do listy
	 * @param string $name nazwa helpera
	 * @return Mmi_Controller_Action_Helper_Abstract
	 */
	public static function getHelper($name) {
		$name = ucfirst($name);
		//helper własny w module
		$moduleName = ucfirst(self::$_actionController->getRequest()->getModuleName());
		$helperName = $moduleName . '_Controller_Helper_' . $name;
		//zwrot jeśli zarejestrowany
		if (isset(self::$_helpers[$helperName])) {
			return self::$_helpers[$helperName];
		}
		//rejestrowanie jeśli brak
		$components = Mmi_Controller_Front::getInstance()->getStructure('module');
		if (isset($components[strtolower($moduleName)]['Controller']['Helper'][$name])) {
			self::$_helpers[$helperName] = new $helperName();
			if (self::$_actionController) {
				self::$_helpers[$helperName]->setActionController(self::$_actionController);
				self::$_helpers[$helperName]->init();
			}
			return self::$_helpers[$helperName];
		}
		//helper wbudowany
		$helperName = 'Mmi_Controller_Action_Helper_' . $name;
		//rejestrowanie jeśli brak
		if (!isset(self::$_helpers[$helperName])) {
			self::$_helpers[$helperName] = new $helperName();
			if (!self::$_actionController) {
				self::$_helpers[$helperName]->setActionController(self::$_actionController());
				self::$_helpers[$helperName]->init();
			}
		}
		return self::$_helpers[$helperName];
	}

	/**
	 * Magiczne wywołanie helpera
	 * @param string $name nazwa
	 * @param array $params parametry
	 * @return mixed
	 */
	public function __call($name, array $params = array()) {
		return call_user_func_array(array(self::getHelper($name), $name), $params);
	}

}