<?php

class Admin_Form_Login extends Mmi_Form {
	
	protected $_recordName = 'Cms_Model_Auth_Record';
	protected $_recordSaveMethod = 'login';

	public function init() {
		$this->addElement('text', 'username', array(
			'label' => 'nazwa użytkownika',
			'description' => 'Wpisz swój unikalny identyfikator',
			'required' => true,
			'filters' => array(
				'StringTrim'
			),
			'validators' => array(
				'NotEmpty',
			),
		));

		$this->addElement('password', 'password', array(
			'label' => 'hasło',
			'validators' => array(
				array('validator' => 'StringLength', 'options' => array(4, 128)),
			)
		));

		$this->addElement('submit', 'login', array(
			'label' => 'Zaloguj się'
		));
	}

}