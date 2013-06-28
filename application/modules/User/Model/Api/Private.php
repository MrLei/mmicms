<?php

class User_Model_Api_Private extends User_Model_Api {

	protected $_users = array(
		'test' => '1234'
	);
	
	/**
	 * Autoryzacja webservice'u
	 * @param string $identity
	 * @param string $credential
	 * @return boolean 
	 */
	public function authenticate($identity, $credential) {
		return isset($this->_users[$identity]) && $this->_users[$identity] == $credential;
	}
	
	/**
	 * Testowa metoda prywatnego api
	 * @return string 
	 */
	public function secret() {
		return 'Here is a nice secret!';
	}
	
}
