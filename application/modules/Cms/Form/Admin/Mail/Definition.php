<?php

class Cms_Form_Admin_Mail_Definition extends Mmi_Form {

	protected $_recordName = 'Cms_Model_Mail_Definition_Record';

	public function init() {

		$this->addElementText('name')
			->setLabel('Unikalna nazwa')
			->setRequired()
			->addValidatorStringLength(6, 25)
			->addValidatorRecordUnique('Cms_Model_Mail_Definition_Dao', 'name', $this->getRecord()->id);

		$this->addElementSelect('mailServerId')
			->setLabel('Połącznie')
			->setRequired()
			->setMultiOptions(Cms_Model_Mail_Server_Dao::getMultioptions());

		$this->addElementText('subject')
			->setLabel('Tytuł')
			->setRequired()
			->addValidatorStringLength(2, 240);

		$this->addElementTextarea('message')
			->setLabel('Treść')
			->setRequired();

		$this->addElementCheckbox('html')
			->setLabel('Wiadomość HTML')
			->setRequired();

		$this->addElementText('fromName')
			->setLabel('Wyświetlana nazwa (Od kogo)')
			->setDescription('np. Pomoc serwisu xyz.pl')
			->setRequired()
			->addValidatorStringLength(2, 240);

		$this->addElementText('replyTo')
			->setLabel('Odpowiedz na')
			->setDescription('Jeśli inny niż z którego wysłano wiadomość')
			->setRequired(false)
			->addValidatorStringLength(2, 240);

		$this->addElementCheckbox('active')
			->setLabel('aktywny')
			->setValue(1)
			->setRequired();

		//submit
		$this->addElementSubmit('submit')
			->setLabel('zapisz mail')
			->setIgnore();
	}

}
