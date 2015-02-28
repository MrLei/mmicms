<?php

namespace Cms\Form\Admin;

/**
 * Klasa formularza edycji artykułu
 */
class Article extends \MmiCms\Form {

	public function init() {

		//tytuł
		$this->addElementText('title')
			->setRequired()
			->addValidatorNotEmpty()
			->setLabel('tytuł');

		//treść
		$this->addElementTinyMce('text')
			->setLabel('treść artykułu')
			->setModeAdvanced();

		//opcja noindex
		$this->addElementCheckbox('noindex')
			->setLabel('Bez indeksowania w google');

		//uploader
		$this->addElementUploader('uploader')
			->setLabel('Załaduj pliki');

		$this->addElementSubmit('submit')
			->setLabel('zapisz stronę');
	}

}
