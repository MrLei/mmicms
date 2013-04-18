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
	 * Metoda główna
	 * @param string $moduleName moduł
	 * @param string $controllerName kontroler
	 * @param string $actionName akcja
	 * @param array $params parametry
	 * @param boolean $fetch true zwróci wynik renderowania, w innym przypadku wyrenderuje do bufora
	 * @return mixed
	 */
	public function action($moduleName = 'default', $controllerName = 'index', $actionName = 'index', array $params = array(), $fetch = false) {
		$front = Mmi_Controller_Front::getInstance();
		$params = array_merge($front->getRequest()->toArray(), $params);
		$params['module'] = $moduleName;
		$params['controller'] = $controllerName;
		$params['action'] = $actionName;
		$controllerClassName = ucfirst($params['module']) . '_Controller_' . ucfirst($params['controller']);
		$controller = new $controllerClassName(new Mmi_Controller_Request($params));
		$actionMethodName = $params['action'] . 'Action';
		$controller->$actionMethodName();
		Mmi_Profiler::event('Run: ' . $controllerClassName . '::' . $actionMethodName);
		$skin = isset($params['skin']) ? $params['skin'] : 'default';
		return Mmi_View::getInstance()->renderTemplate($skin, $moduleName, $controllerName, $actionName, $fetch);
	}

}
