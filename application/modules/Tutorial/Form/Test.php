<?php

class Tutorial_Form_Test extends Mmi_Form {

	protected $_recordName = 'Tutorial_Model_Record';

	public function init() {

		$this->addElementText('data')
			->setLabel('Wpisz jakieś dane:')
			->addFilter('stringTrim')
			->setDescription('')
			->setValue('')
			->setRequired()
			->addValidatorStringLength(2, 128, 'Wprowadź poprawne dane');

		$this->addElementSubmit('add')
			->setLabel('dodaj');
	}

}
