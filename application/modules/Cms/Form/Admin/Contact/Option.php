<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Cms\Form\Admin\Contact;

class Option extends \Mmi\Form {

	public function init() {

		$this->addElementText('name')
			->setLabel('nazwa');

		$this->addElementText('sendTo')
			->setLabel('prześlij na email')
			->setDescription('Wysyła kopię wiadomości od użytkownika bezpośrednio na podany adres e-mail')
			->addValidatorEmailAddress();

		$this->addElementSubmit('submit')
			->setLabel('dodaj temat');
	}

}
