<?php

class Cms_Model_Auth implements Mmi_Auth_Model_Interface {

	public static function authenticate($identity, $credential) {
		$credentialLegacy = sha1($credential);
		$credential = self::getSaltedPasswordHash($credential);
		$record = Cms_Model_Auth_Dao::findFirst(array(
				array('active', 1),
				array(
					array('username', $identity),
					array('email', $identity, '=', 'OR'),
				),
				array(
					array('password', $credential),
					array('password', $credentialLegacy, '=', 'OR'),
					array('password', substr($credential, 0, 40), '=', 'OR')
				)
			));
		if ($record === null) {
			$record = Cms_Model_Auth_Dao::findFirst(array(
					array('active', 1),
					array(
						array('username', $identity),
						array('email', $identity, '=', 'OR'),
					)));
			if ($record !== null) {
				$record->lastFailIp = (isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : null);
				$record->lastFailLog = date('Y-m-d H:i:s');
				$record->failLogCount = $record->failLogCount + 1;
				$record->save();
			}
			Cms_Model_Log_Dao::add('login failed', array(
				'success' => false,
				'message' => 'LOGIN FAILED: ' . $identity));
			return false;
		}
		$record->roles = Cms_Model_Auth_Role_Dao::findPairsRolesByAuthId($record->id);
		$record->lastIp = (isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : null);
		$record->lastLog = date('Y-m-d H:i:s');
		Cms_Model_Log_Dao::add('login', array(
			'object' => 'cms_auth',
			'objectId' => $record->id,
			'cms_auth_id' => $record->id,
			'success' => true,
			'message' => 'LOGGED: ' . $record->username
		));
		return $record;
	}

	public static function idAuthenticate($id) {
		$this->get(array(
			array('id', $id, '=', 'OR'),
			array('username', ((intval($id) > 0) ? intval($id) : -1), '=', 'OR'),
			array('email', $id, '=', 'OR')
		));
		if ($this->getId() > 0) {
			$this->roles = $this->getRoles($this->getId());
			$this->_notifyLogin($this);
			return $this;
		}
		$this->_notifyBadLogin($id);
		return false;
	}

	public static function deauthenticate() {
		Cms_Model_Log_Dao::add('logout', array(
			'object' => 'cms_auth',
			'objectId' => Mmi_Auth::getInstance()->getId(),
			'success' => true,
			'message' => 'LOGGED OUT: ' . Mmi_Auth::getInstance()->getUsername()
		));
	}

	public static function getSaltedPasswordHash($password) {
		return hash('sha512', Mmi_Config::get('global', 'salt') . md5($password) . $password . 'sltd');
	}

}
