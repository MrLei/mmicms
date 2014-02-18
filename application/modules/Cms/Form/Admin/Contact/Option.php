<?php

class Cms_Form_Admin_Contact_Option extends Mmi_Form {

	protected $_recordName = 'Cms_Model_Contact_Option_Record';

	public function init() {

		$this->addElement('text', 'name', array(
			'label' => 'nazwa'
		));

		$this->addElement('text', 'sendTo', array(
			'label' => 'prześlij na email',
			'validators' => array(
				array('validator' => 'EmailAddress'),
			),
			'description' => 'Wysyła kopię wiadomości od użytkownika bezpośrednio na podany adres e-mail'
		));

		$this->addElement('submit', 'submit' , array(
				'label' => 'dodaj temat'
		));

	}

}
