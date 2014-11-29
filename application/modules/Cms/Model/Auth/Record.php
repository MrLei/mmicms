<?php

class Cms_Model_Auth_Record extends Mmi_Dao_Record {

	public $id;
	public $lang;
	public $username;
	public $email;
	public $password;
	public $lastIp;
	public $lastLog;
	public $lastFailIp;
	public $lastFailLog;
	public $failLogCount;
	public $logged;
	public $active;

	public function save() {
		if ($this->getOption('changePassword')) {
			$this->password = Cms_Model_Auth::getSaltedPasswordHash($this->getOption('changePassword'));
		}
		if (!parent::save()) {
			return false;
		}
		if ($this->getOption('cms_roles')) {
			Cms_Model_Auth_Role_Dao::grant($this->id, $this->getOption('cms_roles'));
		}
		return true;
	}

	public function changePassword() {
		if (!($this->id > 0)) {
			return false;
		}
		if ($this->getOption('changePassword') != $this->getOption('confirmPassword')) {
			return false;
		}
		$this->password = Cms_Model_Auth::getSaltedPasswordHash($this->getOption('changePassword'));
		return $this->save();
	}

	public function changePasswordByUser() {
		$auth = new Cms_Model_Auth();
		$record = $auth->authenticate($this->identity, $this->password);
		if ($record === false) {
			$this->_setSaveStatus(-1);
			return false;
		}
		if ($this->getOption('changePassword') != $this->getOption('confirmPassword')) {
			$this->_setSaveStatus(-2);
			return false;
		}
		$auth = new self($record->id);
		$auth->password = Cms_Model_Auth::getSaltedPasswordHash($this->getOption('changePassword'));
		return $auth->save();
	}

	public function login() {
		if ($this->username == null || $this->password == null) {
			return false;
		}
		$auth = Default_Registry::$auth;
		$auth->setModelName('Cms_Model_Auth');
		$auth->setIdentity($this->username);
		$auth->setCredential($this->password);
		$result = $auth->authenticate();
		$this->id = $auth->getId();
		if ($result && isset($this->remember) && $this->remember == 1) {
			$auth->rememberMe(Default_Registry::$config->session->authRemember);
		}
		return $result;
	}

}
