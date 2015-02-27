<?php

namespace Cms\Form\Admin\Mail;

class Definition extends \Mmi\Form {

	protected $_recordName = '\Cms\Model\Mail\Definition\Record';

	public function init() {

		$this->addElementText('name')
			->setLabel('Unikalna nazwa')
			->setRequired()
			->addValidatorStringLength(6, 25)
			->addValidatorRecordUnique('\Cms\Model\Mail\Definition\Dao', 'name', $this->getRecord()->id);

		$this->addElementSelect('mailServerId')
			->setLabel('Połącznie')
			->setRequired()
			->setMultiOptions(\Cms\Model\Mail\Server\Dao::getMultioptions());

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
