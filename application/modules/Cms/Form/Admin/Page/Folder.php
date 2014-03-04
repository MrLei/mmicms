<?php

class Cms_Form_Admin_Page_Folder extends Mmi_Form {

	protected $_recordName = 'Cms_Model_Navigation_Record';
	protected $_recordSaveMethod = 'saveForm';

	public function init() {
		//menu label
		$this->addElementText('label')
				->setLabel('Nazwa folderu')
				->setDescription('Nazwa będzie jednocześnie składową tytułu strony')
				->setRequired()
				->setValidatorStringLength(3, 64);

		//opcjonalny tytuł
		$this->addElementText('title')
				->setLabel('Tytuł strony (meta/title)')
				->setDescription('Jeśli nie wypełniony, zostanie użyta nazwa w menu')
				->setValidatorStringLength(3, 128);

		//opcjonalny opis
		$this->addElementTextarea('description')
				->setLabel('Opis strony (meta/description)')
				->setValidatorStringLength(3, 1024);

		//opcjonalne keywords
		$this->addElementText('keywords')
				->setLabel('Słowa kluczowe (meta/keywords)')
				->setValidatorStringLength(3, 512);

		//pozycja w drzewie
		$this->addElementSelect('parent_id')
				->setLabel('Element nadrzędny')
				->setValue(Mmi_Controller_Front::getInstance()->getRequest()->parent)
				->setMultiOptions(Cms_Model_Navigation_Dao::getMultiOptions());

		//optional url
		$this->addElementSelect('visible')
				->setLabel('Widoczność')
				->setMultiOptions(array(
				1 => 'widoczny',
				0 => 'ukryty',
				))
				->setDescription('Jeśli niewidoczny, jego dane nie wejdą do ścieżki tytułu i okruchów');
		
		$this->addElementDateTimePicker('dateStart')
				->setLabel('Data i czas włączenia');

		$this->addElementDateTimePicker('dateEnd')
				->setLabel('Data i czas wyłączenia');

		$this->addElementCheckbox('active')
				->setLabel('Włączony');

		//submit
		$this->addElementSubmit('submit')
				->setLabel('Zapisz')
				->setIgnore();
	}

	public function prepareSaveData(array $data = array()) {
		$data['module'] = null;
		$data['controller'] = null;
		$data['action'] = null;
		$data['object'] = null;
		$data['uri'] = null;
		return $data;
	}

}