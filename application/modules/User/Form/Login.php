<?php
class User_Form_Login extends Mmi_Form {
	
	public function init() {
		$this->addElement('text', 'username', array(
				'label' => 'Nazwa użytkownika',
				'filters' => array('StringTrim')
		));

		$this->addElement('password', 'password', array(
				'label' => 'Hasło',
				'filters' => array('StringTrim')
		));

		$this->addElement('checkbox', 'remember', array(
				'label' => 'Pamiętaj mnie'
		));

		$this->addElement('submit', 'submit', array(
				'label' => 'Zaloguj się'
		));
	}
}