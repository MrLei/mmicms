<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Cms\Form\Admin;

class News extends \MmiCms\Form {

	public function init() {

		//ustawia zabezpieczenie CSRF
		$this->setSecured();

		$this->addElementText('title')
			->setLabel('Tytuł artykułu')
			->setRequired()
			->addFilter('stringTrim')
			->addValidatorNotEmpty();

		$this->addElementCheckbox('internal')
			->setLabel('Artykuł wewnętrzny')
			->setValue(1);

		$this->addElementText('uri')
			->setLabel('Link do treści zewnętrznej');

		$this->addElementTinyMce('lead')
			->setLabel('Podsumowanie (zajawka)');

		$this->addElementTinyMce('text')
			->setLabel('Treść')
			->setOption('img', 'news:' . $this->_record->id)
			->setRequired()
			->setModeAdvanced();

		$this->addElementSelect('visible')
			->setLabel('Publikacja')
			->setMultiOptions(array(
				1 => 'włączony',
				0 => 'wyłączony',
		));

		$this->addElementUploader('uploader')
			->setLabel('Dołącz pliki');

		$this->addElementSubmit('submit')
			->setIgnore()
			->setLabel('Zapisz');
	}

}
