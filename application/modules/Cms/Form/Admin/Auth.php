<?php

class Cms_Form_Admin_Auth extends Mmi_Form {

	protected $_recordName = 'Cms_Model_Auth_Record';

	public function init() {

		$this->addElementText('username')
			->setLabel('nazwa użytkownika')
			->setRequired()
			->addFilter('stringTrim')
			->addValidatorNotEmpty();

		$this->addElementText('email')
			->setLabel('adres e-mail')
			->setRequired()
			->addFilter('stringTrim')
			->addValidatorEmailAddress();

		$this->addElementMultiCheckbox('cmsRoles')
			->setLabel('role')
			->setDescription('Grupa uprawnień')
			->setMultiOptions(Cms_Model_Role_Query::factory()->findPairs('id', 'name'))
			->setValue(Cms_Model_Auth_Role_Dao::byAuthIdQuery($this->getRecord()->id)->findPairs('cms_role_id', 'cms_role_id'));

		$languages = array();
		foreach (Default_Registry::$config->application->languages as $language) {
			$languages[$language] = $language;
		}

		if (!empty($languages)) {
			$this->addElementSelect('lang')
				->setLabel('język')
				->setMultiOptions($languages)
				->setDescription('Preferowany przez użytkownika język interfejsu');
		}

		$this->addElementCheckbox('active')
			->setLabel('Aktywny');

		$this->addElementText('changePassword')
			->setLabel('zmiana hasła')
			->setDescription('Jeśli nie chcesz zmienić hasła nie wypełniaj tego pola')
			->addValidatorStringLength(4, 128);

		$this->addElementSubmit('submit')
			->setLabel('Zapisz');
	}

}
