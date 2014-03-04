<?php

class Cms_Form_Admin_Page_Article extends Mmi_Form {

	protected $_recordName = 'Cms_Model_Navigation_Record';
	protected $_recordSaveMethod = 'saveForm';

	public function init() {

		//menu label
		$this->addElementText('label')
				->setLabel('Nazwa w menu')
				->setRequired()
				->setValidatorStringLength(3, 64);

		//opcjonalny opis
		$this->addElementTextarea('description')
				->setLabel('Opis strony (meta/description)')
				->setValidatorStringLength(3, 1024);

		//opcjonalne keywords
		$this->addElementText('keywords')
				->setLabel('Słowa kluczowe (meta/keywords)')
				->setValidatorStringLength(3, 64);

		$this->addElementSelect('article_id')
				->setLabel('Artykuł')
				->setMultiOptions(array(null => '---') + Cms_Model_Article_Dao::findPairs('id', 'title', Cms_Model_Article_Dao::newQuery()->orderAsc('title')));

		$this->addElementCheckbox('absolute')
				->setLabel('Link bezwzględny');

		$this->addElementSelect('https')
				->setLabel('Połączenie HTTPS')
				->setMultiOptions(array(
				null => 'bez zmian',
				'0' => 'wymuś http',
				'1' => 'wymuś https',
				));

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
				->setLabel('Zapisz')
				->setIgnore();

	}
}