<?php

class Cms_Model_Auth_Api {

	/**
	 * Autoryzacja użytkowników
	 * @param string $login
	 * @param string $password
	 * @return array
	 */
	public function postLogin($login, $password) {
		$auth = new Cms_Model_Auth();
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
		$auth = new Cms_Model_Auth();
		$authResult = $auth->authenticate($login, $oldPassword);
		if (!$authResult) {
			return false;
		}
		$authResult->changePassword = $newPassword;
		$authResult->confirmPassword = $newPassword;
		return $authResult->changePassword();
	}

}
