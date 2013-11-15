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
		$record = Cms_Model_Auth_Dao::findFirst(array(
			array('id', $id, '=', 'OR'),
			array('username', $id, '=', 'OR'),
			array('email', $id, '=', 'OR')
		));
		if ($record === null) {
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
			'message' => 'LOGGED (ID): ' . $record->username
		));
		return $record;
	}

	public static function deauthenticate() {
		Cms_Model_Log_Dao::add('logout', array(
			'object' => 'cms_auth',
			'objectId' => Default_Registry::$auth->getId(),
			'success' => true,
			'message' => 'LOGGED OUT: ' . Default_Registry::$auth->getUsername()
		));
	}

	public static function getSaltedPasswordHash($password) {
		return hash('sha512', Default_Registry::$config->application->salt . md5($password) . $password . 'sltd');
	}

}
