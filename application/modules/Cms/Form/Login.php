<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Cms\Form;

class Login extends \Mmi\Form {

	protected $_recordSaveMethod = 'login';

	public function init() {
		$this->addElementText('username')
			->setLabel('Nazwa użytkownika')
			->addFilter('stringTrim');

		$this->addElementPassword('password')
			->setLabel('Hasło')
			->addFilter('stringTrim');

		$this->addElementCheckbox('remember')
			->setLabel('Pamiętaj mnie');

		$this->addElementSubmit('submit')
			->setLabel('Zaloguj się');
	}

}
