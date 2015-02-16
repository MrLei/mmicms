<?php

class User_Model_Api_Private extends User_Model_Api {

	protected static $_auth = array(
		'test' => '1234'
	);

	/**
	 * Autoryzacja webservice'u
	 * @param string $identity
	 * @param string $credential
	 * @return boolean 
	 */
	public static function authenticate($identity, $credential) {
		return isset(self::$_auth[$identity]) && self::$_auth[$identity] == $credential;
	}

	/**
	 * Testowa metoda prywatnego api
	 * @return string 
	 */
	public function getSecret() {
		return 'Here is a nice secret!';
	}

}
