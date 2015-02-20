<?php

class Cms_Form_Admin_Mail_Server extends Mmi_Form {

	protected $_recordName = 'Cms_Model_Mail_Server_Record';

	public function init() {

		$this->addElementText('address')
			->setLabel('Adres serwera SMTP');

		$this->addElementSelect('ssl')
			->setLabel('Rodzaj połączenia')
			->setRequired()
			->setMultiOptions(array('plain' => 'plain', 'tls' => 'tls', 'ssl' => 'ssl'));

		$this->addElementText('port')
			->setLabel('Port')
			->setRequired()
			->setValue(25)
			->setDescription('Plain: 25, SSL: 465');

		$this->addElementText('username')
			->setLabel('Nazwa użytkownika');

		$this->addElementText('password')
			->setLabel('Hasło użytkownika');

		$this->addElementText('from')
			->setLabel('Domyślny adres od');

		//submit
		$this->addElementSubmit('submit')
			->setLabel('Zapisz');
	}

}
