<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Cms\Model;

/**
 * Klasa autoryzacji
 */
class Auth implements \Mmi\Auth\AuthInterface {

	/**
	 * Autoryzacja do CMS
	 * @param string $identity
	 * @param string $credential
	 * @return \stdClass|boolean
	 */
	public static function authenticate($identity, $credential) {
		$credentialLegacy = sha1($credential);
		$saltedCred = self::getSaltedPasswordHash($credential);

		//zapytanie wybierające użytkownika
		$qUser = \Cms\Model\Auth\Query::factory()
				->whereUsername()->equals($identity)
				->orFieldEmail()->equals($identity);

		//szukanie po loginie i haśle
		$record = \Cms\Model\Auth\Query::factory()
			->whereActive()->equals(1)
			->andQuery($qUser)
			->andQuery(\Cms\Model\Auth\Query::factory()
				->wherePassword()->equals($saltedCred)
				->orFieldPassword()->equals($credentialLegacy))
			->findFirst();

		//błędna autoryzacja
		if ($record === null) {
			self::_authFailed($identity, $qUser);
			return false;
		}
		
		//poprawna autoryzacja
		$record->setOption('roles', \Cms\Model\Auth\Role\Dao::joinedRolebyAuthId($record->id)->findPairs('cms_role_id', 'name'));
		return self::_authSuccess($record);
	}

	/**
	 * Autoryzacja po ID
	 * @param integer $id
	 * @return boolean
	 */
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
		return self::_authSuccess($record);
	}

	/**
	 * Wylogowanie
	 */
	public static function deauthenticate() {
		//logowanie deautoryzacji
		\Cms\Model\Log\Dao::add('logout', array(
			'object' => 'cms_auth',
			'objectId' => \Core\Registry::$auth->getId(),
			'success' => true,
			'message' => 'LOGGED OUT: ' . \Core\Registry::$auth->getUsername()
		));
	}

	/**
	 * Obsługa błędnego logowania znanego użytkownika
	 * @param string $identity
	 * @param \Cms\Model\Auth\Query $qUser zapytanie o użytkownika
	 */
	protected static function _authFailed($identity, \Cms\Model\Auth\Query $qUser) {
		//logowanie błędnej próby autoryzacji
		\Cms\Model\Log\Dao::add('login failed', array(
			'success' => false,
			'message' => 'LOGIN FAILED: ' . $identity));

		//wybieranie użytkownika po nazwie
		$record = \Cms\Model\Auth\Query::factory()
			->andQuery($qUser)
			->findFirst();

		//błąd logowania nieznanego użytkownika
		if ($record === null) {
			return;
		}
		//zapis danych błędnego logowania znanego użytkownika
		$record->lastFailIp = \Mmi\Controller\Front::getInstance()->getEnvironment()->remoteAddress;
		$record->lastFailLog = date('Y-m-d H:i:s');
		$record->failLogCount = $record->failLogCount + 1;
		$record->save();
	}
	
	/**
	 * Po poprawnej autoryzacji zapis danych i loga
	 * @param \Cms\Model\Auth\Record $record
	 * @return \StdClass
	 */
	protected static function _authSuccess(\Cms\Model\Auth\Record $record) {
		$record->lastIp = \Mmi\Controller\Front::getInstance()->getEnvironment()->remoteAddress;
		$record->lastLog = date('Y-m-d H:i:s');
		$record->save();
		\Cms\Model\Log\Dao::add('login', array(
			'object' => 'cms_auth',
			'objectId' => $record->id,
			'cmsAuthId' => $record->id,
			'success' => true,
			'message' => 'LOGGED: ' . $record->username
		));
		//nowy obiekt autoryzacji
		$authObject = new \stdClass();
		
		//ustawianie pól rekordu w stdClass
		foreach ($record->toArray() as $key => $value) {
			$authObject->$key = $value;
		}
		return $authObject;
	}

	/**
	 * Zwraca hash hasła zakodowany z "solą"
	 * @param string $password
	 * @return string
	 */
	public static function getSaltedPasswordHash($password) {
		return hash('sha512', \Core\Registry::$config->application->salt . md5($password) . $password . 'sltd');
	}

}
