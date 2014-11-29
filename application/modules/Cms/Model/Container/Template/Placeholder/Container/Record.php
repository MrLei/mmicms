<?php

class Cms_Model_Container_Template_Placeholder_Container_Record extends Mmi_Dao_Record {

	public $id;
	public $cmsContainerId;
	public $cmsContainerTemplatePlaceholderId;
	public $module;
	public $controller;
	public $action;
	public $params;
	public $active;
	public $marginTop;
	public $marginRight;
	public $marginBottom;
	public $marginLeft;

	public function save() {
		$object = explode('_', $this->object);
		unset($this->object);
		$this->module = isset($object[0]) ? $object[0] : 'default';
		$this->controller = isset($object[1]) ? $object[1] : 'index';
		$this->action = isset($object[2]) ? $object[2] : 'index';
		$this->marginTop = ($this->marginTop == '') ? null : $this->marginTop;
		$this->marginRight = ($this->marginRight == '') ? null : $this->marginRight;
		$this->marginBottom = ($this->marginBottom == '') ? null : $this->marginBottom;
		$this->marginLeft = ($this->marginLeft == '') ? null : $this->marginLeft;
		return parent::save();
	}

}
