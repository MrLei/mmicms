<?php

class User_Model_Registration extends Cms_Model_Auth {

	public function save() {
		if ($this->password != $this->confirmPassword) {
			return -1;
		}
		if ($this->regulations == 0) {
			return -1;
		}
		$this->changePassword = $this->password;
		unset($this->password);
		$this->lang = 'pl';
		$this->roles = array('member');
		unset($this->regulations);
		unset($this->confirmPassword);
		return parent::save();
	}

}