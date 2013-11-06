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
 * MmiCms/View/Helper/Widget.php
 * @category   MmiCms
 * @package    MmiCms_View
 * @subpackage Helper
 * @copyright  Copyright (c) 2010 HQSoft Mariusz Miłejko (http://www.hqsoft.pl)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    $Id$
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */

/**
 * Helper widgetów
 * @see MmiCms_Controller_Action_Helper_Action
 * @category   MmiCms
 * @package    MmiCms_View
 * @subpackage Helper
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */
class MmiCms_View_Helper_Widget extends Mmi_View_Helper_Abstract {

	/**
	 * Metoda główna, renderuje widget o zadanych parametrach
	 * @param string $module moduł
	 * @param string $controller kontroler
	 * @param string $action akcja
	 * @param array $params parametry
	 * @param int $life buforowanie czasowe (ilość sekund)
	 * @return string
	 */
	public function widget($module, $controller, $action = 'index', array $params = array(), $life = 0) {
		$key = 'Widget_' . Mmi_Controller_Front::getInstance()->getRequest()->lang . '_' . $module . '_' . $controller . '_' . $action . '_' . md5(print_r($params, true)) . implode('-', Mmi_Auth::getInstance()->getRoles());
		if ($life > 0 && null !== ($data = Mmi_Cache::load($key))) {
			return $data;
		}
		$actionHelper = new MmiCms_Controller_Action_Helper_Action();
		$data = $actionHelper->action($module, $controller, $action, $params, true);
		Mmi_Cache::save($data, $key, $life);
		return $data;
	}

}