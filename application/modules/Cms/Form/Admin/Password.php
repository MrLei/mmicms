<?php

class Cms_Form_Admin_Password extends Mmi_Form {

	protected $_recordName = 'Cms_Model_Auth_Record';
	protected $_recordSaveMethod = 'changePasswordByUser';

	public function init() {

		//ustawienie użytkownika w rekordzie
		$this->getRecord()->setOption('identity', Default_Registry::$auth->getUsername());

		$this->addElementPassword('password')
			->setLabel('obecne hasło')
			->setRequired()
			->addValidatorNotEmpty();

		$this->addElementPassword('changePassword')
			->setLabel('nowe hasło')
			->setDescription('wpisz nowe hasło, co najmniej 4 znaki')
			->setRequired()
			->addValidatorStringLength(4, 128);

		$this->addElementPassword('confirmPassword')
			->setLabel('powtórz nowe hasło')
			->setRequired()
			->addValidatorStringLength(4, 128);

		$this->addElementSubmit('change')
			->setLabel('Zmień hasło');
	}

	public function lateInit() {
		if ($this->getRecord()->getSaveStatus() == -1) {
			$this->getElement('password')->addError('Obecne hasło jest nieprawidłowe');
		}
		if ($this->getRecord()->getSaveStatus() == -2) {
			$this->getElement('confirmPassword')->addError('Hasła niezgodne');
		}
	}

}
