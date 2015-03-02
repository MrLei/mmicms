<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Cms\Form\Admin;

class Password extends \Mmi\Form {

	protected $_recordSaveMethod = 'changePasswordByUser';

	public function init() {

		//ustawienie użytkownika w rekordzie
		$this->_record->setOption('identity', \Core\Registry::$auth->getUsername());

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
		if ($this->_record->getSaveStatus() == -1) {
			$this->getElement('password')->addError('Obecne hasło jest nieprawidłowe');
		}
		if ($this->_record->getSaveStatus() == -2) {
			$this->getElement('confirmPassword')->addError('Hasła niezgodne');
		}
	}

}
