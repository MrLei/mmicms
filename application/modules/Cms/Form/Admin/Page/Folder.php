<?php


namespace Cms\Form\Admin\Page;

class Folder extends \MmiCms\Form {

	protected $_recordName = 'Cms\Model\Navigation\Record';
	protected $_recordSaveMethod = 'saveForm';

	public function init() {
		//menu label
		$this->addElementText('label')
			->setLabel('Nazwa folderu')
			->setDescription('Nazwa będzie jednocześnie składową tytułu strony')
			->setRequired()
			->addValidatorStringLength(2, 64);

		//opcjonalny tytuł
		$this->addElementText('title')
			->setLabel('Tytuł strony (meta/title)')
			->setDescription('Jeśli nie wypełniony, zostanie użyta nazwa w menu')
			->addValidatorStringLength(3, 128);

		//opcjonalny opis
		$this->addElementTextarea('description')
			->setLabel('Opis strony (meta/description)')
			->addValidatorStringLength(3, 1024);

		//opcjonalne keywords
		$this->addElementText('keywords')
			->setLabel('Słowa kluczowe (meta/keywords)')
			->addValidatorStringLength(3, 512);

		//pozycja w drzewie
		$this->addElementSelect('parentId')
			->setLabel('Element nadrzędny')
			->setValue(\Mmi\Controller\Front::getInstance()->getRequest()->parent)
			->setMultiOptions(Cms\Model\Navigation\Dao::getMultiOptions());

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
			->setValue(1)
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
