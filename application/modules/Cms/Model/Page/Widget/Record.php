<?php

class Cms_Model_Page_Widget_Record extends Mmi_Dao_Record {

	public $id;
	public $name;
	public $module;
	public $controller;
	public $action;
	public $params;
	public $active;
	public $cmsAuthId;

	public function save() {
		if ($this->getOption('widget')) {
			$widget = explode(':', $this->getOption('widget'));
			$this->module = strtolower($widget[0]);
			$this->controller = strtolower($widget[1]);
			$this->action = $widget[2];
		}
		$this->cmsAuthId = Default_Registry::$auth->getId();
			
		return parent::save();
	}	
	
}