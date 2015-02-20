<?php


namespace Cms\Form;

class Login extends \Mmi\Form {

	protected $_recordName = '\Cms\Model\Auth\Record';
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
