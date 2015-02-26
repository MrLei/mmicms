<?php

namespace Cms\Form\Admin;

class Page extends \MmiCms\Form {

	protected $_recordName = '\Cms\Model\Page\Record';
	protected $_recordSaveMethod = 'saveForm';

	public function init() {

		//nazwa strony
		$this->addElementText('name')
			->setLabel('Nazwa strony')
			->addValidatorStringLength(2, 128)
			->setRequired();

		//adres url do routera
		$this->addElementText('address')
			->setLabel('Adres strony')
			->addFilter('url')
			->addValidatorStringLength(2, 128)
			->setRequired();

		//tytuł
		$this->addElementText('title')
			->setLabel('Tytuł strony (head/title)')
			->addValidatorStringLength(3, 128);

		//meta opis
		$this->addElementTextarea('description')
			->setLabel('Opis strony (meta/description)')
			->addValidatorStringLength(3, 1024);

		$this->addElementCheckbox('active')
			->setLabel('Aktywna')
			->setValue(true);

		//@TODO: do testów
		$this->addElementTextarea('text')
			->setLabel('Treść szablonu (do testów)');

		//ustawianie pól nawigatora i routera
		if ($this->getRecord()->cmsNavigationId && (null !== ($nr = \Cms\Model\Navigation\Dao::findPk($this->getRecord()->cmsNavigationId)))) {
			$this->getElement('title')->setValue($nr->title);
			$this->getElement('description')->setValue($nr->description);
		}
		if ($this->getRecord()->cmsRouteId && (null !== ($rr = \Cms\Model\Route\Dao::findPk($this->getRecord()->cmsRouteId)))) {
			$this->getElement('address')->setValue($rr->pattern);
		}

		//submit
		$this->addElementSubmit('submit')
			->setLabel('Zapisz')
			->setIgnore();
	}

}
