<?php

class User_Form_Registration extends Mmi_Form {

	protected $_modelName = 'User_Model_Registration';

	public function init() {

		$this->addElement('text', 'username', array(
			'label' => 'nazwa użytkownika (nick)',
			'required' => true,
			'validators' => array(
				array('validator' => 'Alnum'),
				array('validator' => 'RecordUnique', 'options' => array('Cms_Model_Auth_Dao', 'username')),
				array('validator' => 'StringLength', 'options' => array(4, 25))
			),
			'filters' => array('filter' => 'Lowercase')
		));


		$this->addElement('text', 'email', array(
			'label' => 'e-mail',
			'required' => true,
			'validators' => array(
				array('validator' => 'EmailAddress'),
				array('validator' => 'RecordUnique', 'options' => array('Cms_Model_Auth_Dao', 'email')),
				array('validator' => 'StringLength', 'options' => array(4, 150))
			),
			'filters' => array('filter' => 'Lowercase')
		));

		// Create and configure password element:
		$this->addElement('password', 'password', array(
			'label' => 'hasło',
			'required' => true,
			'validators' => array(
				array('validator' => 'StringLength', 'options' => array(4, 64))
			)
		));

		$this->addElement('password', 'confirmPassword', array(
			'label' => 'potwierdź hasło',
		));

		$this->addElement('captcha', 'regCaptcha', array('label' => 'Przepisz kod'));

		$this->addElement('checkbox', 'regulations', array(
			'label' => 'Akceptuję regulamin',
			'required' => true
		));

		$this->addElement('submit', 'submit', array(
			'label' => 'Zarejestruj'
		));
	}

}