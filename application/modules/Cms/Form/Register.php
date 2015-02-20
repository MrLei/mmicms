<?php


namespace Cms\Form;

class Register extends \MmiCms\Form {

	protected $_recordName = 'Cms\Model\Auth\Record';
	protected $_recordSaveMethod = 'register';

	public function init() {

		$this->addElementText('username')
			->setLabel('nazwa użytkownika (nick)')
			->setRequired()
			->addValidatorAlnum()
			->addValidatorRecordUnique('Cms\Model\Auth\Dao', 'username')
			->addValidatorStringLength(4, 25)
			->addFilter('lowercase');

		$this->addElementText('email')
			->setLabel('e-mail')
			->setRequired()
			->addValidatorEmailAddress()
			->addValidatorRecordUnique('Cms\Model\Auth\Dao', 'email')
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
