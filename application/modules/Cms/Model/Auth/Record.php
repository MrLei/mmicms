<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

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

	/**
	 * Zapis rekordu
	 * @return boolean
	 */
	public function save() {
		//ustawiona opcja zmiany hasła
		if ($this->getOption('changePassword')) {
			//zapis "osolonego" hasła
			$this->password = \Cms\Model\Auth::getSaltedPasswordHash($this->getOption('changePassword'));
		}
		//próba zapisu
		if (!parent::save()) {
			return false;
		}
		//ustawiona opcja nadania uprawnień
		if ($this->getOption('cmsRoles')) {
			//nadawanie uprawnień
			\Cms\Model\Auth\Role\Dao::grant($this->id, $this->getOption('cmsRoles'));
		}
		return true;
	}

	/**
	 * Akcja zmiany hasła
	 * @return boolean
	 */
	public function changePassword() {
		//brak rekordu
		if (!($this->id > 0)) {
			return false;
		}
		//hasła niezgodne
		if ($this->getOption('changePassword') != $this->getOption('confirmPassword')) {
			return false;
		}
		//zapis "osolonego" hasła
		$this->password = \Cms\Model\Auth::getSaltedPasswordHash($this->getOption('changePassword'));
		return $this->save();
	}

	/**
	 * Zmiana hasła przez aktualnie zalogowanego użytkownika
	 * @return boolean
	 */
	public function changePasswordByUser() {
		$auth = new \Cms\Model\Auth();
		$record = $auth->authenticate($this->getOption('identity'), $this->password);
		//logowanie niepoprawne
		if ($record === false) {
			$this->_setSaveStatus(-1);
			return false;
		}
		//hasła niezgodne
		if ($this->getOption('changePassword') != $this->getOption('confirmPassword')) {
			$this->_setSaveStatus(-2);
			return false;
		}
		$authRecord = new self($record->id);
		$authRecord->password = \Cms\Model\Auth::getSaltedPasswordHash($this->getOption('changePassword'));
		return $authRecord->save();
	}

	/**
	 * Logowanie
	 * @return boolean
	 */
	public function login() {
		//brak loginu lub hasła
		if ($this->username == null || $this->password == null) {
			return false;
		}
		//autoryzacja
		$auth = \Core\Registry::$auth;
		$auth->setModelName('\Cms\Model\Auth');
		$auth->setIdentity($this->username);
		$auth->setCredential($this->password);
		$result = $auth->authenticate();
		//pobranie ID
		$this->id = $auth->getId();
		//zapamiętanie jeśli zaznaczona opcja
		if ($result && isset($this->remember) && $this->remember == 1) {
			$auth->rememberMe(\Core\Registry::$config->session->authRemember);
		}
		return $result;
	}

	/**
	 * Rejestracja użytkownika
	 * @return boolean
	 */
	public function register() {
		//hasła nie zgadzają się
		if ($this->password != $this->getOption('confirmPassword')) {
			return false;
		}
		//opcja zmiany (w tym przypadku ustawienia nowego) hasłą
		$this->setOption('changePassword', $this->password);
		//domyślny język
		$this->lang = 'pl';
		return $this->save();
	}

}
