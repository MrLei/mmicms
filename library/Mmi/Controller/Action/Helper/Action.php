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
 * Mmi/Controller/Action/Helper/Action.php
 * @category   Mmi
 * @package    \Mmi\Controller
 * @subpackage Helper
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    1.0.0
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

/**
 * Helper akcji, wykonuje akcję z kontrolera akcji i zwraca bądź renderuje wynik
 * @category   Mmi
 * @package    \Mmi\Controller
 * @subpackage Helper
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

namespace Mmi\Controller\Action\Helper;

class Action extends \Mmi\Controller\Action\Helper\HelperAbstract {

	/**
	 * Obiekt ACL
	 * @var \Mmi\Acl
	 */
	protected static $_acl;

	/**
	 * Obiekt Auth
	 * @var \Mmi\Auth
	 */
	protected static $_auth;

	/**
	 * Ustawia obiekt ACL
	 * @param \Mmi\Acl $acl
	 * @return \Mmi\Acl
	 */
	public static function setAcl(\Mmi\Acl $acl) {
		self::$_acl = $acl;
		return $acl;
	}

	/**
	 * Ustawia obiekt autoryzacji
	 * @param \Mmi\Auth $auth
	 * @return \Mmi\Auth
	 */
	public static function setAuth(\Mmi\Auth $auth) {
		self::$_auth = $auth;
		return $auth;
	}

	/**
	 * Metoda główna
	 * @param string $moduleName moduł
	 * @param string $controllerName kontroler
	 * @param string $actionName akcja
	 * @param array $params parametry
	 * @param boolean $fetch true zwróci wynik renderowania, w innym przypadku wyrenderuje do bufora
	 * @return mixed
	 */
	public function action($moduleName = 'default', $controllerName = 'index', $actionName = 'index', array $params = array()) {
		\Mmi\Profiler::event('Action execute: ' . $moduleName . ':' . $controllerName . ':' . $actionName);
		if (!$this->_checkAcl($moduleName, $controllerName, $actionName)) {
			return;
		}
		$frontRequest = \Mmi\Controller\Front::getInstance()->getRequest();
		//budowanie parametrów kontrollera
		$params['module'] = $moduleName;
		$params['controller'] = $controllerName;
		$params['action'] = $actionName;
		$params = array_merge($frontRequest->toArray(), $params);
		$controllerRequest = new \Mmi\Controller\Request($params);
		//ustawienie requestu w widoku
		\Mmi\Controller\Front::getInstance()->getView()->setRequest($controllerRequest);
		//powołanie kontrolera
		$controllerParts = explode('-', $controllerRequest->getControllerName());
		foreach ($controllerParts as $key => $controllerPart) {
			$controllerParts[$key] = ucfirst($controllerPart);
		}
		$controllerClassName = ucfirst($controllerRequest->getModuleName()) . '\\Controller\\' . implode('\\', $controllerParts);
		$actionMethodName = $controllerRequest->getActionName() . 'Action';
		$controller = new $controllerClassName($controllerRequest);
		//wywołanie akcji
		$directContent = $controller->$actionMethodName();
		//jeśli akcja zwraca cokolwiek, automatycznie jest to content
		if ($directContent !== null) {
			\Mmi\Controller\Front::getInstance()->getView()
				->setLayoutDisabled()
				->setRequest($frontRequest);
			return $directContent;
		}
		//rendering szablonu jeśli akcja zwraca null
		$skin = $controllerRequest->getParam('skin') ? $controllerRequest->getParam('skin') : 'default';
		$content = \Mmi\Controller\Front::getInstance()->getView()->renderTemplate($skin, $moduleName, $controllerName, $actionName);
		//przywrócenie do widoku request'a z front controllera
		\Mmi\Controller\Front::getInstance()->getView()->setRequest($frontRequest);
		return $content;
	}

	/**
	 * Sprawdza uprawnienie do widgetu
	 * @param string $module moduł
	 * @param string $controller kontroler
	 * @param string $action akcja
	 * @return boolean
	 */
	protected function _checkAcl($module, $controller, $action) {
		if (self::$_acl === null || self::$_auth === null) {
			return true;
		}
		$roles = self::$_auth->getRoles();
		return self::$_acl->isAllowed($roles, strtolower($module . ':' . $controller . ':' . $action));
	}

}
