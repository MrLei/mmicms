<?php

class Cms_Model_Auth implements Mmi_Auth_Model_Interface {

	public static function authenticate($identity, $credential) {
		$credentialLegacy = sha1($credential);
		$credential = self::getSaltedPasswordHash($credential);

		$qUser = Cms_Model_Auth_Dao::newQuery()
				->where('username')->equals($identity)
				->orField('email')->equals($identity);

		$qPassword = Cms_Model_Auth_Dao::newQuery()
				->where('password')->equals($credential)
				->orField('password')->equals($credentialLegacy)
				->orField('password')->equals(substr($credential, 0, 40));

		$q = Cms_Model_Auth_Dao::newQuery()
			->where('active')->equals(1)
			->andQuery($qUser)
			->andQuery($qPassword);

		$record = Cms_Model_Auth_Dao::findFirst($q);

		if ($record === null) {
			$q = Cms_Model_Auth_Dao::newQuery()
				->where('active')->equals(1)
				->andQuery($qUser);
			$record = Cms_Model_Auth_Dao::findFirst($q);
			if ($record !== null) {
				$record->lastFailIp = Mmi_Controller_Front::getInstance()->getEnvironment()->remoteAddress;
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
		$record->lastIp = Mmi_Controller_Front::getInstance()->getEnvironment()->remoteAddress;
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
		$q = Cms_Model_Auth_Dao::newQuery()
				->where('id')->equals($id)
				->orField('username')->equals($id)
				->orField('email')->equals($id);
		$record = Cms_Model_Auth_Dao::findFirst($q);
		if ($record === null) {
			return false;
		}
		$record->roles = Cms_Model_Auth_Role_Dao::findPairsRolesByAuthId($record->id);
		$record->lastIp = Mmi_Controller_Front::getInstance()->getEnvironment()->remoteAddress;
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
