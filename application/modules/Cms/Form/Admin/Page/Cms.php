<?php


namespace Cms\Form\Admin\Page;

class Cms extends \MmiCms\Form {

	protected $_recordName = 'Cms\Model\Navigation\Record';
	protected $_recordSaveMethod = 'saveForm';

	public function init() {
		//menu label
		$this->addElementText('label')
			->setLabel('Nazwa w menu')
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

		$this->addElementCheckbox('independent')
			->setLabel('Niezależne meta');

		//system object
		$this->addElementSelect('object')
			->setLabel(\Mmi\Controller\Front::getInstance()->getView()->getTranslate()->_('Obiekt CMS'))
			->setDescription(\Mmi\Controller\Front::getInstance()->getView()->getTranslate()->_('Istniejące obiekty CMS'))
			->setRequired()
			->setOption('id', 'objectId');

		$object = $this->getElement('object');
		$object->setDisableTranslator(true);
		$object->addMultiOption(null, null);
		foreach (Cms\Model\Reflection::getActions() as $action) {
			$object->addMultiOption($action['path'], $action['module'] . ': ' . $action['controller'] . ' - ' . $action['action']);
		}
		//optional params
		$this->addElementText('params')
			->setLabel('Parametry obiektu')
			->setDescription('Dodatkowe parametry adresu w obiekcie');

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
			->setLabel('Zapisz')
			->setIgnore();
	}

}
