<?php


namespace Cms\Form\Admin\Stat;

class Label extends \Mmi\Form {

	protected $_recordName = 'Cms\Model\Stat\Label\Record';

	public function init() {

		$this->addElementSelect('object')
			->setLabel('klucz')
			->addValidatorNotEmpty()
			->setRequired()
			->setMultiOptions(Cms\Model\Stat\Date\Dao::getUniqueObjects());

		$this->addElementText('label')
			->setLabel('nazwa statystyki')
			->setRequired();

		$this->addElementTextarea('description')
			->setLabel('opis');

		$this->addElementSubmit('submit')
			->setLabel('zapisz');
	}

}
