<?php

class Cms_Form_Admin_Container_Template extends Mmi_Form {

	protected $_recordName = 'Cms_Model_Container_Template_Record';

	public function init() {

		$this->addElementText('name')
			->setRequired()
			->setLabel('nazwa szablonu')
			->addValidatorNotEmpty();

		$this->addElementTextarea('text')
			->setLabel('kod szablonu');

		$this->addElementSubmit('submit')
			->setLabel('zapisz szablon');
	}

}
