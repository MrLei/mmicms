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
 * Mmi/View/Helper/Widget.php
 * @category   Mmi
 * @package    Mmi_View
 * @subpackage Helper
 * @copyright  Copyright (c) 2010 HQSoft Mariusz Miłejko (http://www.hqsoft.pl)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    $Id$
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */

/**
 * Helper widgetów
 * @see Mmi_Acl
 * @category   Mmi
 * @package    Mmi_View
 * @subpackage Helper
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */
class Mmi_View_Helper_Widget extends Mmi_View_Helper_Abstract {

	/**
	 * Metoda główna, renderuje widget o zadanych parametrach
	 * @param <type> $module moduł
	 * @param <type> $controller kontroler
	 * @param <type> $action akcja
	 * @param array $params parametry
	 * @param int $life buforowanie czasowe (ilość sekund)
	 * @return string
	 */
	public function widget($module, $controller, $action = 'index', array $params = array(), $life = 0) {
		if (!$this->_checkAcl($module, $controller, $action)) {
			return;
		}
		$lang = Mmi_Controller_Front::getInstance()->getRequest()->lang;
		$key = 'Widget_' . $lang . '_' . $module . '_' . $controller . '_' . $action . '_' . implode('-', $params);
		if (Mmi_Auth::getInstance()->hasIdentity()) {
			$key .= implode('-', Mmi_Auth::getInstance()->getRoles());
		}
		$params['_widget'] = true;
		if ($life == 0 || !Mmi_Config::$data['cache']['active'] || null === ($data = Mmi_Cache::getInstance()->load($key))) {
			$actionHelper = new Mmi_Controller_Action_Helper_Action();
			$data = $actionHelper->action($module, $controller, $action, $params, true);
			if ($life > 0 && Mmi_Config::$data['cache']['active']) {
				Mmi_Cache::getInstance()->save($data, $key, $life);
			}
		}
		Mmi_View::getInstance()->request = Mmi_Controller_Front::getInstance()->getRequest();
		return $data;
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
		$acl = Mmi_Registry::get('Mmi_Acl');
		if (null == $acl) {
			return true;
		}
		$this->_role = $roles;
		return $acl->isAllowed($roles, $module . ':' . $controller . ':' .$action);
	}

}