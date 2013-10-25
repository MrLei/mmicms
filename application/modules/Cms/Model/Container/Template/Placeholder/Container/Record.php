<?php

class Cms_Model_Container_Template_Placeholder_Container_Record extends Mmi_Dao_Record {

	public function save() {
		$object = explode('_', $this->object);
		unset($this->object);
		$this->module = isset($object[0]) ? $object[0] : 'default';
		$this->controller = isset($object[1]) ? $object[1] : 'index';
		$this->action = isset($object[2]) ? $object[2] : 'index';
		return parent::save();
	}

}