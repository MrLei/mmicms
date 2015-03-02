<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Cms\Form\Admin\Page;

class Widget extends \Mmi\Form {

	protected $_recordName = '\Cms\Model\Page\Widget\Record';

	public function init() {

		$this->addElementText('name')
			->setLabel('Nazwa widgetu');

		$this->addElementSelect('widget')
			->setMultiOptions(array_merge(array('' => ''), $this->_availableWidgetsAndComponents()))
			->setLabel('Wybierz widget lub komponent')
			->setValue($this->getOption('widget'));

		$this->addElementText('params')
			->setLabel('Domyślne parametry');

		$this->addElementCheckbox('active')
			->setLabel('Aktywny');

		$this->addElementSubmit('submit')
			->setLabel('Zapisz');
	}

	protected function _availableWidgetsAndComponents() {
		$widgets = array();
		$components = array();
		foreach (glob(APPLICATION_PATH . '/modules/*') as $module) {
			$moduleName = substr($module, strrpos($module, '/') + 1);
			foreach (glob($module . '/Controller/*.php') as $controller) {
				$var = file_get_contents($controller);
				$controllerName = substr($controller, strrpos($controller, '/') + 1, -4);
				if (preg_match_all('/function ([a-zA-Z0-9]+WidgetAction)\(/', $var, $actions) && isset($actions[1])) {
					foreach ($actions[1] as $action) {
						$action = substr($action, 0, -6);
						$widgets[$moduleName . ':' . $controllerName . ':' . $action] = $moduleName . ' - ' . $controllerName . ' - ' . $action;
					}
				}
				if ($moduleName === 'Component') {
					$var = file_get_contents($controller);
					$controllerName = substr($controller, strrpos($controller, '/') + 1, -4);
					if (preg_match_all('/function ([a-zA-Z0-9]+Action)\(/', $var, $actions) && isset($actions[1])) {
						foreach ($actions[1] as $action) {
							$action = substr($action, 0, -6);
							$components[$moduleName . ':' . $controllerName . ':' . $action] = $moduleName . ' - ' . $controllerName . ' - ' . $action;
						}
					}
				}
			}
		}
		return array_merge($widgets, $components);
	}

}
