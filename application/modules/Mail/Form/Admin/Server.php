<?php

class Mail_Form_Admin_Server extends Mmi_Form {

	protected $_recordName = 'Mail_Model_Server_Record';

	public function init() {

		$this->addElement('text', 'address', array(
			'label' => 'Adres serwera SMTP'
		));

		$this->addElement('select', 'ssl', array(
			'label' => 'Rodzaj połączenia',
			'required' => true,
			'multiOptions' => array('plain' => 'plain', 'tls' => 'tls', 'ssl' => 'ssl')
		));

		$this->addElement('text', 'port', array(
			'label' => 'Port',
			'value' => 25,
			'required' => true,
			'description' => 'Plain: 25, SSL: 465'
		));

		$this->addElement('text', 'username', array(
			'label' => 'Nazwa użytkownika'
		));

		$this->addElement('text', 'password', array(
			'label' => 'Hasło użytkownika'
		));

		$this->addElement('text', 'from', array(
			'label' => 'Domyślny adres od'
		));

		//submit
		$this->addElement('submit', 'submit', array(
			'label' => 'Zapisz'
		));
	}

}