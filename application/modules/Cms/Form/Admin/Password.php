<?php

namespace Cms\Form\Admin;

class Password extends \Mmi\Form {

	protected $_recordName = '\Cms\Model\Auth\Record';
	protected $_recordSaveMethod = 'changePasswordByUser';

	public function init() {

		//ustawienie użytkownika w rekordzie
		$this->getRecord()->setOption('identity', \Core\Registry::$auth->getUsername());

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
