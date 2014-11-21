<?php

class Cms_Form_Admin_Tag extends Mmi_Form {

	protected $_recordName = 'Cms_Model_Tag_Record';

	public function init() {

		$this->addElementText('tag')
			->setLabel('tag')
			->setRequired()
			->addFilter('StringTrim')
			->addValidatorStringLength(2, 64);

		$this->addElementSubmit('submit')
			->setLabel('zapisz')
			->setIgnore();
	}

}
