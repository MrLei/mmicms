<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Cms\Form\Admin;

class Login extends \Mmi\Form {

	protected $_recordSaveMethod = 'login';

	public function init() {

		$this->addElementText('username')
			->setLabel('nazwa użytkownika')
			->setDescription('Wpisz swój unikalny identyfikator')
			->addFilter('stringTrim');

		$this->addElementPassword('password')
			->setLabel('hasło')
			->addValidatorStringLength(4, 128);

		$this->addElementSubmit('login')
			->setLabel('Zaloguj się');
	}

}
