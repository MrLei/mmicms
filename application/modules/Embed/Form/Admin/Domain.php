<?php

class Embed_Form_Admin_Domain extends Mmi_Form {

	protected $_recordName = 'Embed_Model_Domain_Record';

	public function init() {

		$this->addElementText('name')
			->setLabel('Nazwa domeny')
			->setRequired();

		$this->addElementSubmit('submit')
			->setLabel('Zapisz');
	}

}
