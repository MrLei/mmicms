<?php

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
