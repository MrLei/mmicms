<?php

class Cms_Form_Admin_Auth extends Mmi_Form {

	protected $_recordName = 'Cms_Model_Auth_Record';

	public function init() {

		$this->addElementText('username')
			->setLabel('nazwa użytkownika')
			->setRequired()
			->addFilter('stringTrim')
			->addValidatorNotEmpty();
		
		$this->addElement('text', 'email', array(
			'label' => 'adres e-mail',
			'required' => true,
			'filters' => array(
				'StringTrim'
			),
			'validators' => array(
				'EmailAddress',
			),
		));

		$this->addElement('multiCheckbox', 'cms_roles', array(
			'label' => 'role',
			'value' => Cms_Model_Auth_Role_Dao::findRolesIdByAuthId($this->getRecord()->id),
			'multiOptions' => Cms_Model_Role_Dao::findPairs('id', 'name'),
			'description' => 'Grupa uprawnień'
		));

		$languages = array();
		foreach (Default_Registry::$config->application->languages as $language) {
			$languages[$language] = $language;
		}

		$this->addElement('select', 'lang', array(
			'label' => 'język',
			'multiOptions' => $languages,
			'description' => 'Preferowany przez użytkownika język interfejsu'
		));

		$this->addElement('checkbox', 'active', array(
			'label' => 'Aktywny'
		));

		$this->addElement('text', 'changePassword', array(
			'label' => 'zmiana hasła',
			'value' => '',
			'validators' => array(
				array('validator' => 'StringLength', 'options' => array(4, 128)),
			),
			'description' => 'Jeśli nie chcesz zmienić hasła nie wypełniaj tego pola'
		));

		$this->addElement('submit', 'submit', array(
			'label' => 'Zapisz'
		));
	}

}