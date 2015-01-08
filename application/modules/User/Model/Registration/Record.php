<?php

class User_Model_Registration_Record extends Cms_Model_Auth_Record {

	public function save() {
		if ($this->password != $this->getOption('confirmPassword')) {
			return false;
		}
		$this->setOption('changePassword', $this->password);
		$this->lang = 'pl';
		return parent::save();
	}

}
