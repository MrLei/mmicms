<?php

class Admin_Form_Password extends Mmi_Form {
	
	protected $_recordName = 'Cms_Model_Auth_Record';
	protected $_recordSaveMethod = 'changePasswordByUser';

	public function init() {
		
		//ustawienie użytkownika w rekordzie
		$this->getRecord()->identity = Mmi_Auth::getInstance()->getUsername();

		$this->addElement('password', 'password', array(
			'label' => 'obecne hasło',
			'required' => true,
			'validators' => array(
				array('validator' => 'NotEmpty'),
			),
		));
		
		$this->addElement('password', 'changePassword', array(
			'label' => 'nowe hasło',
			'description' => 'wpisz nowe hasło, co najmniej 4 znaki',
			'required' => true,
			'validators' => array(
				array('validator' => 'StringLength', 'options' => array(4, 128)),
			),
		));

		$this->addElement('password', 'confirmPassword', array(
			'label' => 'powtórz nowe hasło',
			'required' => true,
			'validators' => array(
				array('validator' => 'StringLength', 'options' => array(4, 128)),
			),
		));

		$this->addElement('submit', 'change', array(
			'label' => 'Zmień hasło'
		));
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