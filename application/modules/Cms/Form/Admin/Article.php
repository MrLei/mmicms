<?php

class Cms_Form_Admin_Article extends MmiCms_Form {

	protected $_recordName = 'Cms_Model_Article_Record';

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
