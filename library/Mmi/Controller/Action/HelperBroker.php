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
 * 
 * Metody wywoływane magicznie przez __call
 * @method null redirector() redirector($action = null, $controller = null, $module = null, array $params = array(), $reset = false) Helper przekierowań
 * @method null messenger() messenger($message, $type = null, array $variables = array()) Helper wiadomości
 * @method null action() action($moduleName = 'default', $controllerName = 'index', $actionName = 'index', array $params = array()) Helper akcji
 */
class Mmi_Controller_Action_HelperBroker {

	/**
	 * Request
	 * @var Mmi_Controller_Request
	 */
	private static $_request;
	
	/**
	 * Lista helperów
	 * @var array
	 */
	private static $_helpers = array();

	/**
	 * Konstruktor
	 */
	public function __construct(Mmi_Controller_Request $request) {
		self::$_request = $request;
		foreach (self::$_helpers as $helper) {
			/* @var $helper Mmi_Controller_Action_Helper_Abstract */
			$helper->setRequest($request)
				->init();
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
	 * @return Mmi_Controller_Action_Helper_Abstract
	 */
	public static function addHelper(Mmi_Controller_Action_Helper_Abstract $helper) {
		self::$_helpers[get_class($helper)] = $helper;
		$helper->init();
		if (self::$_request) {
			$helper->setRequest(self::$_request);
		}
		return self::$_helpers[get_class($helper)];
	}
	
	/**
	 * Pobiera helper, jeśli nie jest utworzony, tworzy go i dodaje do listy
	 * @param string $name nazwa helpera
	 * @return Mmi_Controller_Action_Helper_Abstract
	 */
	public static function getHelper($name) {
		$name = ucfirst($name);
		//helper własny w module
		if (self::$_request && null !== ($helper = self::_getModuleHelper($name))) {
			return $helper;
		}
		//helper systemowy
		if (null !== ($helper = self::_getSystemHelper($name))) {
			return $helper;
		}
		throw new Exception('Mmi_Controller_Action_HelperBroker: ' . $name . ' helper not found');
	}
	
	/**
	 * Pobiera helper modułowy
	 * @param string $name
	 * @return Mmi_Controller_Action_Helper_Abstract
	 */
	protected static function _getModuleHelper($name) {
		$moduleName = ucfirst(self::$_request->getModuleName());
		$helperName = $moduleName . '_Controller_Helper_' . $name;
		//zwrot jeśli zarejestrowany
		if (isset(self::$_helpers[$helperName])) {
			return self::$_helpers[$helperName];
		}
		//rejestrowanie jeśli brak
		$components = Mmi_Controller_Front::getInstance()->getStructure('module');
		//brak komponentu
		if (!isset($components[strtolower($moduleName)]['Controller']['Helper'][$name])) {
			return;
		}
		return self::addHelper(new $helperName());
	}
	
	/**
	 * Pobiera helper systemowy
	 * @param string $name
	 * @return Mmi_Controller_Action_Helper_Abstract
	 */
	protected static function _getSystemHelper($name) {
		$helperName = 'Mmi_Controller_Action_Helper_' . $name;
		//zwrot jeśli zarejestrowany
		if (isset(self::$_helpers[$helperName])) {
			return self::$_helpers[$helperName];
		}
		//rejestrowanie jeśli brak
		try {
			return self::addHelper(new $helperName());
		} catch (Exception $e) {
			return;
		}
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