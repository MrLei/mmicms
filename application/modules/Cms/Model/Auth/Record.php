<?php

class Cms_Model_Auth_Record extends Mmi_Dao_Record {

	public function save() {
		if ($this->changePassword) {
			$this->password = Cms_Model_Auth::getSaltedPasswordHash($this->changePassword);
		}
		if ($this->cms_roles) {
			$roles = $this->cms_roles;
		}
		if (!parent::save()) {
			return false;
		}
		if (isset($roles)) {
			Cms_Model_Auth_Role_Dao::grant($this->id, $roles);
		}
		return true;
	}

	public function changePassword() {
		if (!($this->id > 0)) {
			return false;
		}
		if ($this->changePassword != $this->confirmPassword) {
			return false;
		}
		$this->password = Cms_Model_Auth::getSaltedPasswordHash($this->changePassword);
		return $this->save();
	}
	
	public function changePasswordByUser() {
		$auth = new Cms_Model_Auth();
		$record = $auth->authenticate($this->identity, $this->password);
		if ($record === false) {
			$this->_setSaveStatus(-1);
			return false;
		}
		if ($this->changePassword != $this->confirmPassword) {
			$this->_setSaveStatus(-2);
			return false;
		}
		$auth = new self($record->id);
		$auth->password = Cms_Model_Auth::getSaltedPasswordHash($this->changePassword);
		return $auth->save();
	}

	public function login() {
		if ($this->username == null || $this->password == null) {
			return false;
		}
		$auth = Mmi_Auth::getInstance();
		$auth->setModelName('Cms_Model_Auth');
		$auth->setIdentity($this->username);
		$auth->setCredential($this->password);
		$result = $auth->authenticate();
		$this->id = $auth->getId();
		if ($result && isset($this->remember) && $this->remember == 1) {
			$auth->rememberMe(Mmi_Config::$data['session']['remember_me_seconds']);
		}
		return $result;
	}

}