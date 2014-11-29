<?php

class Cms_Model_Comment_Record extends Mmi_Dao_Record {

	public $id;
	public $cmsAuthId;
	public $parentId;
	public $dateAdd;
	public $title;
	public $text;
	public $signature;
	public $ip;
	public $stars;
	public $object;
	public $objectId;

	protected function _insert() {
		$this->dateAdd = date('Y-m-d H:i:s');
		$auth = Default_Registry::$auth;
		if ($auth->hasIdentity()) {
			$this->signature = $auth->getUsername();
			$this->cms_auth_id = $auth->getId();
		} else {
			$this->signature = '~' . $this->signature;
			$this->ip = Mmi_Controller_Front::getInstance()->getEnvironment()->remoteAddress;
		}
		return parent::_insert();
	}

}
