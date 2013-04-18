<?php

class Cms_Model_Comment_Record extends Mmi_Dao_Record {

	protected function _insert() {
		$this->dateAdd = date('Y-m-d H:i:s');
		$auth = Mmi_Auth::getInstance();
		if ($auth->hasIdentity()) {
			$this->signature = $auth->getUsername();
			$this->cms_auth_id = $auth->getId();
		} else {
			$this->signature = '~' . $this->signature;
			$this->ip = $_SERVER['REMOTE_ADDR'];
		}
		return parent::_insert();
	}

}