<?php

class Cms_Form_Contact extends MmiCms_Form {

	protected $_recordName = 'Cms_Model_Contact_Record';

	public function init() {

		$this->setSecured();

		if (!$this->getOption('subjectId')) {
			$this->addElementSelect('cmsContactOptionId')
				->setLabel('Wybierz temat')
				->setMultiOptions(Cms_Model_Contact_Option_Dao::getMultioptions())
				->addValidatorInteger();
		}

		$auth = Default_Registry::$auth;
		$this->addElementText('email')
			->setLabel('Twój adres email')
			->setValue($auth->getEmail())
			->setRequired()
			->addValidatorEmailAddress();

		$this->addElementTextarea('text')
			->setLabel('Wiadomość')
			->setRequired()
			->addFilter('StripTags');

		if (!($auth->getId() > 0)) {
			//captcha dla niezalogowanych
			$this->addElementCaptcha('regCaptcha')
				->setLabel('Przepisz kod');
		}

		$this->addElementSubmit('submit')
			->setLabel('Wyślij');
	}

	public function prepareSaveData(array $data = array()) {
		if ($this->getOption('subjectId') > 0) {
			$data['cmsContactOptionId'] = $this->getOption('subjectId');
		}
		return $data;
	}

}
