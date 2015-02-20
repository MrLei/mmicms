<?php


namespace Cms\Form\Admin;

class Login extends \Mmi\Form {

	protected $_recordName = 'Cms\Model\Auth\Record';
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
