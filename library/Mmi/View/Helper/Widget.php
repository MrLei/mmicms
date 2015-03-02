<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
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
