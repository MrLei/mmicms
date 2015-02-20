<?php

class Cms_Form_Admin_Stat_Label extends Mmi_Form {

	protected $_recordName = 'Cms_Model_Stat_Label_Record';

	public function init() {

		$this->addElementSelect('object')
			->setLabel('klucz')
			->addValidatorNotEmpty()
			->setRequired()
			->setMultiOptions(Cms_Model_Stat_Date_Dao::getUniqueObjects());

		$this->addElementText('label')
			->setLabel('nazwa statystyki')
			->setRequired();

		$this->addElementTextarea('description')
			->setLabel('opis');

		$this->addElementSubmit('submit')
			->setLabel('zapisz');
	}

}
