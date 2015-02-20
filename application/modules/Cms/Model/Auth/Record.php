<?php


namespace Cms\Model\Auth;

class Record extends \Mmi\Dao\Record {

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
			$this->password = Cms\Model\Auth::getSaltedPasswordHash($this->getOption('changePassword'));
		}
		if (!parent::save()) {
			return false;
		}
		if ($this->getOption('cmsRoles')) {
			Cms\Model\Auth\Role\Dao::grant($this->id, $this->getOption('cmsRoles'));
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
		$this->password = Cms\Model\Auth::getSaltedPasswordHash($this->getOption('changePassword'));
		return $this->save();
	}

	public function changePasswordByUser() {
		$auth = new \Cms\Model\Auth();
		$record = $auth->authenticate($this->getOption('identity'), $this->password);
		if ($record === false) {
			$this->_setSaveStatus(-1);
			return false;
		}
		if ($this->getOption('changePassword') != $this->getOption('confirmPassword')) {
			$this->_setSaveStatus(-2);
			return false;
		}
		$authRecord = new self($record->id);
		$authRecord->password = Cms\Model\Auth::getSaltedPasswordHash($this->getOption('changePassword'));
		return $authRecord->save();
	}

	public function login() {
		if ($this->username == null || $this->password == null) {
			return false;
		}
		$auth = Core\Registry::$auth;
		$auth->setModelName('Cms\Model\Auth');
		$auth->setIdentity($this->username);
		$auth->setCredential($this->password);
		$result = $auth->authenticate();
		$this->id = $auth->getId();
		if ($result && isset($this->remember) && $this->remember == 1) {
			$auth->rememberMe(Core\Registry::$config->session->authRemember);
		}
		return $result;
	}
	
	public function register() {
		if ($this->password != $this->getOption('confirmPassword')) {
			return false;
		}
		$this->setOption('changePassword', $this->password);
		$this->lang = 'pl';
		return $this->save();
	}

}
