<?php

/**
 * @property integer $id
 * @property integer $cms_auth_id
 * @property integer $parent_id
 * @property string $dateAdd
 * @property string $title
 * @property string $text
 * @property string $signature
 * @property string $ip
 * @property float $stars
 * @property string $object
 * @property integer $objectId
 */
class Cms_Model_Comment_Record extends Mmi_Dao_Record {

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