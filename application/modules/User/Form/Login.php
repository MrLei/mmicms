<?php

class User_Form_Login extends Mmi_Form {

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
