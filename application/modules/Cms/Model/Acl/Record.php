<?php

class Cms_Model_Acl_Record extends Mmi_Dao_Record {

	public function save() {
		if ($this->object) {
			$object = explode(':', $this->object);
			$this->module = isset($object[0]) ? strtolower($object[0]) : null;
			$this->controller = isset($object[1]) ? strtolower($object[1]) : null;
			$this->action = isset($object[2]) ? strtolower($object[2]) : null;
			unset($this->object);
		}
		$this->_clearCache();
		return parent::save();
	}

	public function delete() {
		$this->_clearCache();
		return parent::delete();
	}

	protected function _clearCache() {
		MmiCar_Cache_Front::remove('Mmi_Navigation_' . Mmi_Controller_Front::getInstance()->getRequest()->lang);
		MmiCar_Cache_Front::remove('Mmi_Acl');
	}

}