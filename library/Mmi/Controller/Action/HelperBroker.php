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
 * @package    \Mmi\Controller
 * @subpackage Helper
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    1.0.0
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */
/**
 * Broker helperów kontrolera akcji
 * @category   Mmi
 * @package    \Mmi\Controller
 * @subpackage Helper
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 * 
 * Metody wywoływane magicznie przez __call
 * @method \Mmi\Controller\Action\Helper\Redirector redirector() redirector($action = null, $controller = null, $module = null, array $params = array(), $reset = false) Helper przekierowań
 * @method \Mmi\Controller\Action\Helper\Messenger messenger() messenger($message, $type = null, array $variables = array()) Helper wiadomości
 * @method \Mmi\Controller\Action\Helper\Action action() action($moduleName = 'default', $controllerName = 'index', $actionName = 'index', array $params = array()) Helper akcji
 */

namespace Mmi\Controller\Action;

class HelperBroker {

	/**
	 * Request
	 * @var \Mmi\Controller\Request
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
	public function __construct(\Mmi\Controller\Request $request) {
		self::$_request = $request;
		foreach (self::$_helpers as $helper) {
			/* @var $helper \Mmi\Controller\Action\Helper\Abstract */
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
	 * @param \Mmi\Controller\Action\Helper\Abstract $helper
	 * @return \Mmi\Controller\Action\Helper\Abstract
	 */
	public static function addHelper(\Mmi\Controller\Action\Helper\HelperAbstract $helper) {
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
	 * @return \Mmi\Controller\Action\Helper\Abstract
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
		throw new Exception('\Mmi\Controller\Action\HelperBroker: ' . $name . ' helper not found');
	}

	/**
	 * Pobiera helper modułowy
	 * @param string $name
	 * @return \Mmi\Controller\Action\Helper\Abstract
	 */
	protected static function _getModuleHelper($name) {
		$moduleName = ucfirst(self::$_request->getModuleName());
		$helperName = $moduleName . '_Controller\Helper\\' . $name;
		//zwrot jeśli zarejestrowany
		if (isset(self::$_helpers[$helperName])) {
			return self::$_helpers[$helperName];
		}
		//rejestrowanie jeśli brak
		$components = \Mmi\Controller\Front::getInstance()->getStructure('module');
		//brak komponentu
		if (!isset($components[strtolower($moduleName)]['Controller']['Helper'][$name])) {
			return;
		}
		return self::addHelper(new $helperName());
	}

	/**
	 * Pobiera helper systemowy
	 * @param string $name
	 * @return \Mmi\Controller\Action\Helper\Abstract
	 */
	protected static function _getSystemHelper($name) {
		$helperName = '\Mmi\Controller\Action\Helper\\' . $name;
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
