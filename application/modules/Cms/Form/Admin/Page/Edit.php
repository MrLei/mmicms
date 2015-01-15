<?php

class Cms_Form_Admin_Page_Edit extends MmiCms_Form {

	protected $_recordName = 'Cms_Model_Page_Record';
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
			->setLabel('Aktywna');

		//@TODO: do testów
		$this->addElementTextarea('text')
			->setLabel('Treść szablonu (do testów)');

		//submit
		$this->addElementSubmit('submit')
			->setLabel('Zapisz')
			->setIgnore();
	}

}
