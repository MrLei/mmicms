<?php

class User_Model_Api {

	/**
	 * Autoryzacja użytkowników
	 * @param string $login
	 * @param string $password
	 * @return array
	 */
	public function login($login, $password) {
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
	public function changePassword($login, $oldPassword, $newPassword) {
		$auth = new Cms_Model_Auth();
		$auth = $auth->authenticate($login, $oldPassword);
		if (!$auth) {
			return false;
		}
		$auth->changePassword = $newPassword;
		$auth->confirmPassword = $newPassword;
		return $auth->changePassword();
	}

	/**
	 * Pomoc
	 * @param string $method
	 * @return string 
	 */
	public function help($method = null) {
		if (!$method) {
			return 'Method list: authorize(), changePassword()';
		}
		switch ($method) {
			case 'authorize':
				return 'Array authorize(string $login, string $password)';
				break;
			case 'changePassword':
				return 'bool changePassword(string $login, string $oldPassword, string $newPassword)';
				break;
			default:
				return 'method: ' . $method . ' not found';
		}
	}

}
