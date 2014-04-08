<?php

class Cms_Form_Admin_Container_Template_Placeholder extends Mmi_Form {

	protected $_recordName = 'Cms_Model_Container_Template_Placeholder_Record';

	public function init() {

		if (!$this->getRecord()->cms_container_template_id) {
			$this->getRecord()->cms_container_template_id = $this->getOption('templateId');
		}
		
		$this->addElementText('name')
			->setLabel('nazwa placeholder')
			->setRequired()
			->addValidatorNotEmpty();

		$this->addElementText('placeholder')
			->setLabel('klucz placeholdera')
			->setRequired()
			->addValidatorNotEmpty();

		$this->addElementSubmit('submit')
			->setLabel('zapisz placeholder');
	}

}
