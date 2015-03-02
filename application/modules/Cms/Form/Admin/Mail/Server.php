<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Cms\Form\Admin\Mail;

class Server extends \Mmi\Form {

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
