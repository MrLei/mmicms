<?php

class Cms_Form_Admin_Page_Link extends Mmi_Form {

	protected $_recordName = 'Cms_Model_Navigation_Record';
	protected $_recordSaveMethod = 'saveForm';

	public function init() {
		//menu label
		$this->addElementText('label')
				->setLabel('Tekst linku (href-text)')
				->setRequired()
				->setValidatorStringLength(3, 64);

		//optional url
		$this->addElementText('uri')
				->setLabel('Adres strony')
				->setDescription('w formacie http://...')
				->setRequired()
				->setValidatorStringLength(6, 255);

		//menu label
		$this->addElementText('title')
				->setLabel('Tytuł linku');

		//optional url
		$this->addElementSelect('visible')
				->setLabel('Pokazuj w menu')
				->setMultiOptions(array(
				1 => 'widoczny',
				0 => 'ukryty',
				));

		$this->addElementCheckbox('nofollow')
			->setLabel('Atrybut rel="nofollow"');

		$this->addElementCheckbox('blank')
			->setLabel('W nowym oknie');

		//pozycja w drzewie
		$this->addElementSelect('parent_id')
			->setLabel('Element nadrzędny')
			->setValue(Mmi_Controller_Front::getInstance()->getRequest()->parent)
			->setMultiOptions(Cms_Model_Navigation_Dao::getMultiOptions());

		$this->addElementDateTimePicker('dateStart')
			->setLabel('Data i czas włączenia');

		$this->addElementDateTimePicker('dateEnd')
			->setLabel('Data i czas wyłączenia');

		$this->addElementCheckbox('active')
			->setLabel('Włączony');

		//submit
		$this->addElementSubmit('submit')
			->setLabel('Zapisz');

	}

	public function prepareSaveData(array $data = array()) {
		$data['object'] = null;
		return $data;
	}

}