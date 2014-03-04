<?php

class Cms_Form_Admin_Contact_Option extends Mmi_Form {

	protected $_recordName = 'Cms_Model_Contact_Option_Record';

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
