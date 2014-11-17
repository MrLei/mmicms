<?php

class User_Model_Registration_Record extends Cms_Model_Auth_Record {

	public function save() {
		if ($this->password != $this->confirmPassword) {
			return false;
		}
		$this->changePassword = $this->password;
		$this->lang = 'pl';
		return parent::save();
	}

}