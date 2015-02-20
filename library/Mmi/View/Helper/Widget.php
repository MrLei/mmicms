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
 * Mmi/View/Helper/Widget.php
 * @category   Mmi
 * @package    \Mmi\View
 * @subpackage Helper
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    1.0.0
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

/**
 * Helper widgetów
 * @see \Mmi\Controller\Action\Helper\Action
 * @category   Mmi
 * @package    \Mmi\View
 * @subpackage Helper
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

namespace Mmi\View\Helper;

class Widget extends HelperAbstract {

	/**
	 * Metoda główna, renderuje widget o zadanych parametrach
	 * @param string $module moduł
	 * @param string $controller kontroler
	 * @param string $action akcja
	 * @param array $params parametry
	 * @return string
	 */
	public function widget($module, $controller, $action = 'index', array $params = array()) {
		$actionHelper = new \Mmi\Controller\Action\Helper\Action();
		$isLayoutDisabled = $this->view->isLayoutDisabled();
		$actionResult = $actionHelper->action($module, $controller, $action, $params, true);
		$this->view->setLayoutDisabled($isLayoutDisabled);
		return $actionResult;
	}

}
