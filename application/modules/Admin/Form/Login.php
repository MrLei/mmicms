<?php

class Admin_Form_Login extends Mmi_Form {

	protected $_recordName = 'Cms_Model_Auth_Record';
	protected $_recordSaveMethod = 'login';

	public function init() {

		$this->addElementText('username')
			->setLabel('nazwa użytkownika')
			->setDescription('Wpisz swój unikalny identyfikator')
			->addFilter('stringTrim');

		$this->addElementPassword('password')
			->setLabel('hasło')
			->addValidatorStringLength(4, 128);

		$this->addElementSubmit('login')
			->setLabel('Zaloguj się');

	}

}