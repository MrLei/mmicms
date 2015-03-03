<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Cms\Model\Acl;

class Record extends \Mmi\Dao\Record {

	public $id;
	public $cmsRoleId;
	public $module;
	public $controller;
	public $action;
	public $access;

	public function save() {
		if ($this->getOption('object')) {
			$object = explode(':', $this->getOption('object'));
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
		\Core\Registry::$cache->remove('Mmi-Navigation-');
		\Core\Registry::$cache->remove('Mmi-Navigation-' . \Mmi\Controller\Front::getInstance()->getRequest()->lang);
		\Core\Registry::$cache->remove('Mmi-Acl');
	}

}
