<?php

class User_Form_Registration extends MmiCms_Form {

	protected $_recordName = 'User_Model_Registration_Record';

	public function init() {

		$this->addElementText('username')
			->setLabel('nazwa użytkownika (nick)')
			->setRequired()
			->addValidatorAlnum()
			->addValidatorRecordUnique('Cms_Model_Auth_Dao', 'username')
			->addValidatorStringLength(4, 25)
			->addFilter('lowercase');

		$this->addElementText('email')
			->setLabel('e-mail')
			->setRequired()
			->addValidatorEmailAddress()
			->addValidatorRecordUnique('Cms_Model_Auth_Dao', 'email')
			->addValidatorStringLength(4, 150)
			->addFilter('lowercase');

		// Create and configure password element:
		$this->addElementPassword('password')
			->setLabel('hasło')
			->setRequired()
			->addValidatorStringLength(4, 64);

		$this->addElementPassword('confirmPassword')
			->setLabel('potwierdź hasło');

//		$this->addElementAntirobot('robots');

		$this->addElementCheckbox('regulations')
			->setLabel('Akceptuję regulamin')
			->setRequired();

		$this->addElementSubmit('submit')
			->setLabel('Zarejestruj');
	}

}
