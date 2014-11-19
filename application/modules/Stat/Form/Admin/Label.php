<?php

class Stat_Form_Admin_Label extends Mmi_Form {

	protected $_recordName = 'Stat_Model_Label_Record';

	public function init() {

		$this->addElementSelect('object')
			->setLabel('klucz')
			->setRequired()
			->setMultiOptions(Stat_Model_Date_Dao::findUniqueObjects());

		$this->addElementText('label')
			->setLabel('nazwa statystyki')
			->setRequired();

		$this->addElementTextarea('description')
			->setLabel('opis');

		$this->addElementSubmit('submit')
			->setLabel('zapisz');
	}

}
