<?php

class Cms_Form_Admin_Widget_Picture extends MmiCms_Form {

	protected $_recordName = 'Cms_Model_Widget_Picture_Record';
	
	public function init() {

		$this->addElementUploader('uploader')
			->setLabel('Załaduj');

		$this->addElementSubmit('submit')
			->setLabel('Zapisz zdjęcie');
	}

}
