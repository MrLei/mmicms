<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Cms\Form\Admin\Mail;

class Definition extends \Mmi\Form {

	public function init() {

		$this->addElementText('name')
			->setLabel('Unikalna nazwa')
			->setRequired()
			->addValidatorStringLength(6, 25)
			->addValidatorRecordUnique('\Cms\Model\Mail\Definition\Dao', 'name', $this->_record->id);

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
