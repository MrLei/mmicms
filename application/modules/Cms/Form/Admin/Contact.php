<?php

class Cms_Form_Admin_Contact extends Mmi_Form {

	protected $_recordName = 'Cms_Model_Contact_Record';
	protected $_recordSaveMethod = 'reply';

	public function init() {

		if (!$this->getOption('subjectId')) {
			$this->addElementSelect('cms_contact_option_id')
				->setDisabled()
				->setIgnore()
				->setValue($this->getOption('subjectId'))
				->setMultiOptions(Cms_Model_Contact_Option_Dao::getMultioptions())
				->setLabel('temat zapytania');
		}

		$this->addElementText('email')
			->setDisabled()
			->setLabel('email')
			->setValue(Default_Registry::$auth->getEmail())
			->addValidatorEmailAddress();

		$this->addElementTextarea('text')
			->setDisabled()
			->setLabel('treść zapytania');

		$this->addElementTextarea('reply')
			->setRequired()
			->setLabel('odpowiedź');

		$this->addElementSubmit('submit')
			->setLabel('odpowiedz');
	}

}
