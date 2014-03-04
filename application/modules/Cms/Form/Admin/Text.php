<?php

class Cms_Form_Admin_Text extends Mmi_Form {

	protected $_recordName = 'Cms_Model_Text_Record';

	public function init() {

		$this->addElementText('key')
			->setLabel('klucz');

		$this->addElementTextarea('content')
			->setLabel('zawartość');

		$this->addElementSubmit('submit')
			->setLabel('zapisz tekst');

	}
}
