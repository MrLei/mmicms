<?php


namespace Cms\Form\Admin\Page;

class Link extends \MmiCms\Form {

	protected $_recordName = 'Cms\Model\Navigation\Record';
	protected $_recordSaveMethod = 'saveForm';

	public function init() {
		//menu label
		$this->addElementText('label')
			->setLabel('Tekst linku (href-text)')
			->setRequired()
			->addValidatorStringLength(2, 64);

		//optional url
		$this->addElementText('uri')
			->setLabel('Adres strony')
			->setDescription('w formacie http://...')
			->setRequired()
			->addValidatorStringLength(6, 255);

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
		$this->addElementSelect('parentId')
			->setLabel('Element nadrzędny')
			->setValue(\Mmi\Controller\Front::getInstance()->getRequest()->parent)
			->setMultiOptions(Cms\Model\Navigation\Dao::getMultiOptions());

		$this->addElementDateTimePicker('dateStart')
			->setLabel('Data i czas włączenia');

		$this->addElementDateTimePicker('dateEnd')
			->setLabel('Data i czas wyłączenia');

		$this->addElementCheckbox('active')
			->setValue(1)
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
