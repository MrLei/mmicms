<?php

class Cms_Form_Login extends Mmi_Form {

	protected $_recordName = 'Cms_Model_Auth_Record';
	protected $_recordSaveMethod = 'login';

	public function init() {
		$this->addElementText('username')
			->setLabel('Nazwa użytkownika')
			->addFilter('stringTrim');

		$this->addElementPassword('password')
			->setLabel('Hasło')
			->addFilter('stringTrim');

		$this->addElementCheckbox('remember')
			->setLabel('Pamiętaj mnie');

		$this->addElementSubmit('submit')
			->setLabel('Zaloguj się');
	}

}
