<?php


namespace Tutorial\Form;

class Test extends \Mmi\Form {

	protected $_recordName = 'Tutorial\Model\Record';

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
