<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Cms\Model\Page\Widget;

class Record extends \Mmi\Dao\Record {

	public $id;
	public $name;
	public $module;
	public $controller;
	public $action;
	public $params;
	public $active;

	public function save() {
		if ($this->getOption('widget')) {
			$widget = explode(':', $this->getOption('widget'));
			$this->module = strtolower($widget[0]);
			$this->controller = strtolower($widget[1]);
			$this->action = $widget[2];
		}

		return parent::save();
	}

	public function isExistWidgetEdit($action) {
		$structure = \Mmi\Structure::getStructure();
		return array_key_exists($action . 'Edit', $structure['module']['cms']['admin-widget']);
	}

}
