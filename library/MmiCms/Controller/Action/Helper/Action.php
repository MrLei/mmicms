<?php

/**
 * MmiCms
 *
 * LICENSE
 *
 * Ten plik źródłowy objęty jest licencją BSD bez klauzuli ogłoszeniowej.
 * Licencja jest dostępna pod adresem: http://www.hqsoft.pl/new-bsd
 * W przypadku problemów, prosimy o kontakt na adres office@hqsoft.pl
 *
 * MmiCms/Controller/Action/Helper/Action.php
 * @category   MmiCms
 * @package    MmiCms_Controller
 * @subpackage Helper
 * @copyright  Copyright (c) 2010 HQSoft Mariusz Miłejko (http://www.hqsoft.pl)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    $Id$
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */

/**
 * Helper akcji, sprawdza uprawnienia w ACL, wykonuje akcję z kontrolera akcji i zwraca bądź renderuje wynik
 * @category   MmiCms
 * @package    MmiCms_Controller
 * @subpackage Helper
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */
class MmiCms_Controller_Action_Helper_Action extends Mmi_Controller_Action_Helper_Action {

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
		return parent::action($moduleName, $controllerName, $actionName, $params, $fetch);
	}

	/**
	 * Sprawdza uprawnienie do widgetu
	 * @param string $module moduł
	 * @param string $controller kontroler
	 * @param string $action akcja
	 * @return boolean
	 */
	protected function _checkAcl($module, $controller, $action) {
		$roles = Mmi_Auth::getInstance()->getRoles();
		$acl = Default_Registry::$acl;
		if (null === $acl) {
			return true;
		}
		return $acl->isAllowed($roles, $module . ':' . $controller . ':' . $action);
	}

}
