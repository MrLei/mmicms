<?php

namespace Cms\Form\Admin;

class Article extends \MmiCms\Form {

	protected $_recordName = '\Cms\Model\Article\Record';

	public function init() {

		$this->addElementText('title')
			->setRequired()
			->addValidatorNotEmpty()
			->setLabel('tytuł');

		$this->addElementTinyMce('text')
			->setLabel('treść artykułu')
			->setModeAdvanced();

		$this->addElementCheckbox('noindex')
			->setLabel('Bez indeksowania w google');

		//uploader
		$this->addElementUploader('uploader')
			->setLabel('Załaduj pliki');

		$this->addElementSubmit('submit')
			->setLabel('zapisz stronę');
	}

}
