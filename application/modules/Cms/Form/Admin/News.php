<?php

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
