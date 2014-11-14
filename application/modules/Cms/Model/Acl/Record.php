<?php

class Cms_Model_Acl_Record extends Mmi_Dao_Record {

	/**
	 *
	 * @var integer
	 */
	public $id;

	/**
	 *
	 * @var integer
	 */
	public $cms_role_id;

	/**
	 *
	 * @var string
	 */
	public $module;

	/**
	 *
	 * @var string
	 */
	public $controller;

	/**
	 *
	 * @var string
	 */
	public $action;

	/**
	 *
	 * @var string
	 */
	public $access;
    
    protected $_extras = array('cms_role');
    
	public function save() {
		if ($this->object) {
			$object = explode(':', $this->object);
			$this->module = isset($object[0]) ? strtolower($object[0]) : null;
			$this->controller = isset($object[1]) ? strtolower($object[1]) : null;
			$this->action = isset($object[2]) ? strtolower($object[2]) : null;
		}
		$this->_clearCache();
		return parent::save();
	}

	public function delete() {
		$this->_clearCache();
		return parent::delete();
	}

	protected function _clearCache() {
		Default_Registry::$cache->remove('Mmi_Navigation_');
		Default_Registry::$cache->remove('Mmi_Navigation_' . Mmi_Controller_Front::getInstance()->getRequest()->lang);
		Default_Registry::$cache->remove('Mmi_Acl');
	}

}