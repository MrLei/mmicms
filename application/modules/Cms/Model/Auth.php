<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Cms\Model;

class Auth implements \Mmi\Auth\AuthInterface {

	public static function authenticate($identity, $credential) {
		$credentialLegacy = sha1($credential);
		$credential = self::getSaltedPasswordHash($credential);

		$qUser = \Cms\Model\Auth\Query::factory()
				->whereUsername()->equals($identity)
				->orFieldEmail()->equals($identity);

		$qPassword = \Cms\Model\Auth\Query::factory()
				->wherePassword()->equals($credential)
				->orFieldPassword()->equals($credentialLegacy)
				->orFieldPassword()->equals(substr($credential, 0, 40));

		$record = \Cms\Model\Auth\Query::factory()
			->whereActive()->equals(1)
			->andQuery($qUser)
			->andQuery($qPassword)
			->findFirst();

		if ($record === null) {
			$record = \Cms\Model\Auth\Query::factory()
				->whereActive()->equals(1)
				->andQuery($qUser)
				->findFirst();
			if ($record !== null) {
				$record->lastFailIp = \Mmi\Controller\Front::getInstance()->getEnvironment()->remoteAddress;
				$record->lastFailLog = date('Y-m-d H:i:s');
				$record->failLogCount = $record->failLogCount + 1;
				$record->save();
			}
			\Cms\Model\Log\Dao::add('login failed', array(
				'success' => false,
				'message' => 'LOGIN FAILED: ' . $identity));
			return false;
		}
		$record->setOption('roles', \Cms\Model\Auth\Role\Dao::joinedRolebyAuthId($record->id)->findPairs('cms_role_id', 'name'));
		$record->lastIp = \Mmi\Controller\Front::getInstance()->getEnvironment()->remoteAddress;
		$record->lastLog = date('Y-m-d H:i:s');
		\Cms\Model\Log\Dao::add('login', array(
			'object' => 'cms_auth',
			'objectId' => $record->id,
			'cmsAuthId' => $record->id,
			'success' => true,
			'message' => 'LOGGED: ' . $record->username
		));
		$authObject = new \stdClass();
		foreach ($record->toArray() as $key => $value) {
			$authObject->$key = $value;
		}
		return $authObject;
	}

	public static function idAuthenticate($id) {
		$q = \Cms\Model\Auth\Query::factory()
				->where('id')->equals($id)
				->orField('username')->equals($id)
				->orField('email')->equals($id);
		$record = \Cms\Model\Auth\Query::factory()->findFirst();
		if ($record === null) {
			return false;
		}
		$record->setOption('roles', \Cms\Model\Auth\Role\Dao::joinedRolebyAuthId($record->id)->findPairs('cms_role_id', 'name'));
		$record->lastIp = \Mmi\Controller\Front::getInstance()->getEnvironment()->remoteAddress;
		$record->lastLog = date('Y-m-d H:i:s');
		\Cms\Model\Log\Dao::add('login', array(
			'object' => 'cms_auth',
			'objectId' => $record->id,
			'cmsAuthId' => $record->id,
			'success' => true,
			'message' => 'LOGGED (ID): ' . $record->username
		));
		return $record;
	}

	public static function deauthenticate() {
		\Cms\Model\Log\Dao::add('logout', array(
			'object' => 'cms_auth',
			'objectId' => \Core\Registry::$auth->getId(),
			'success' => true,
			'message' => 'LOGGED OUT: ' . \Core\Registry::$auth->getUsername()
		));
	}

	public static function getSaltedPasswordHash($password) {
		return hash('sha512', \Core\Registry::$config->application->salt . md5($password) . $password . 'sltd');
	}

}
