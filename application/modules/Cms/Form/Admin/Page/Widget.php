<?php

class Cms_Form_Admin_Page_Widget extends Mmi_Form {

	protected $_recordName = 'Cms_Model_Page_Widget_Record';

	public function init() {

		$reflection = new Admin_Model_Reflection();

		$this->addElementText('name')
			->setLabel('Nazwa widgetu');

		$this->addElementSelect('widget')
			->setMultiOptions(array_merge(array('' => ''), $reflection->getOptionsWidget()))
			->setLabel('Wybierz widget');

		$this->addElementText('params')
			->setLabel('Domyślne parametry');

		$this->addElementCheckbox('active')
			->setLabel('Aktywny');

		$this->addElementSubmit('submit')
			->setLabel('Zapisz');
	}

}
