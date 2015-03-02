<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Cms\Form\Admin;

class Page extends \MmiCms\Form {

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
		if ($this->_record->cmsNavigationId && (null !== ($nr = \Cms\Model\Navigation\Query::factory()->findPk($this->_record->cmsNavigationId)))) {
			$this->getElement('title')->setValue($nr->title);
			$this->getElement('description')->setValue($nr->description);
		}
		if ($this->_record->cmsRouteId && (null !== ($rr = \Cms\Model\Route\Query::factory()->findPk($this->_record->cmsRouteId)))) {
			$this->getElement('address')->setValue($rr->pattern);
		}

		//submit
		$this->addElementSubmit('submit')
			->setLabel('Zapisz')
			->setIgnore();
	}

}
