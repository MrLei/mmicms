<?php

class Cms_Form_Admin_Role extends Mmi_Form {

	protected $_recordName = 'Cms_Model_Role_Record';

	public function init() {

		$this->addElementText('name')
			->addValidatorStringLength(3, 64);

		$this->addElementSubmit('submit')
			->setLabel('utwórz rolę');
	}

}
