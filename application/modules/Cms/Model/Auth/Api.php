<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Cms\Model\Auth;

class Api {

	/**
	 * Autoryzacja użytkowników
	 * @param string $login
	 * @param string $password
	 * @return array
	 */
	public function postLogin($login, $password) {
		$auth = new \Cms\Model\Auth();
		if ($auth->authenticate($login, $password)) {
			return $auth->toArray();
		}
		return array();
	}

	/**
	 * Zmiana hasła użytkownika
	 * @param string $login
	 * @param string $oldPassword
	 * @param string $newPassword
	 * @return boolean 
	 */
	public function postChangePassword($login, $oldPassword, $newPassword) {
		$auth = new \Cms\Model\Auth();
		$authResult = $auth->authenticate($login, $oldPassword);
		if (!$authResult) {
			return false;
		}
		$authResult->changePassword = $newPassword;
		$authResult->confirmPassword = $newPassword;
		return $authResult->changePassword();
	}

}
