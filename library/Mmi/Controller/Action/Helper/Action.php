<?php

/**
 * Mmi
 *
 * LICENSE
 *
 * Ten plik źródłowy objęty jest licencją BSD bez klauzuli ogłoszeniowej.
 * Licencja jest dostępna pod adresem: http://www.hqsoft.pl/new-bsd
 * W przypadku problemów, prosimy o kontakt na adres office@hqsoft.pl
 *
 * Mmi/Controller/Action/Helper/Action.php
 * @category   Mmi
 * @package    Mmi_Controller
 * @subpackage Helper
 * @copyright  Copyright (c) 2010 HQSoft Mariusz Miłejko (http://www.hqsoft.pl)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    $Id$
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */

/**
 * Helper akcji, wykonuje akcję z kontrolera akcji i zwraca bądź renderuje wynik
 * @category   Mmi
 * @package    Mmi_Controller
 * @subpackage Helper
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */
class Mmi_Controller_Action_Helper_Action extends Mmi_Controller_Action_Helper_Abstract {

	/**
	 * Obiekt ACL
	 * @var Mmi_Acl
	 */
	protected static $_acl;

	/**
	 * Ustawia obiekt ACL
	 * @param Mmi_Acl $acl
	 * @return \Mmi_Acl
	 */
	public static function setAcl(Mmi_Acl $acl) {
		self::$_acl = $acl;
		return $acl;
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
	public function action($moduleName = 'default', $controllerName = 'index', $actionName = 'index', array $params = array(), $fetch = false) {
		if (!$this->_checkAcl($moduleName, $controllerName, $actionName)) {
			return;
		}
		$frontRequest = Mmi_Controller_Front::getInstance()->getRequest();
		//budowanie parametrów kontrollera
		$params['module'] = $moduleName;
		$params['controller'] = $controllerName;
		$params['action'] = $actionName;
		$params = array_merge($frontRequest->toArray(), $params);
		$controllerRequest = new Mmi_Controller_Request($params);
		//ustawienie requestu w widoku
		Mmi_View::getInstance()->setRequest($controllerRequest);
		//powołanie kontrolera
		$controllerClassName = ucfirst($controllerRequest->getModuleName()) . '_Controller_' . ucfirst($controllerRequest->getControllerName());
		$actionMethodName = $controllerRequest->getActionName() . 'Action';
		$controller = new $controllerClassName($controllerRequest);
		//wywołanie akcji
		$controller->$actionMethodName();
		Mmi_Profiler::event('Run: ' . $controllerClassName . '::' . $actionMethodName);
		//rendering szablonu
		$skin = $controllerRequest->getParam('skin') ? $controllerRequest->getParam('skin') : 'default';
		$content = Mmi_View::getInstance()->renderTemplate($skin, $moduleName, $controllerName, $actionName, $fetch);
		//przywrócenie do widoku request'a z front controllera
		Mmi_View::getInstance()->setRequest($frontRequest);
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
		if (self::$_acl === null) {
			return true;
		}
		return self::$_acl->isAllowed(Mmi_Auth::getInstance()->getRoles(), $module . ':' . $controller . ':' . $action);
	}

}
