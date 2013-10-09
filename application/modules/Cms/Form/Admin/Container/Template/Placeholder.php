<?php

class Cms_Form_Admin_Container_Template_Placeholder extends Mmi_Form {

	protected $_recordName = 'Cms_Model_Container_Template_Placeholder_Record';

	public function init() {

		if (!$this->getRecord()->cms_container_template_id) {
			$this->getRecord()->cms_container_template_id = $this->getOption('templateId');
		}

		$this->addElement('text', 'name', array(
			'label' => 'nazwa placeholdera',
			'required' => true,
			'validators' => array('NotEmpty'),
		));

		$this->addElement('text', 'placeholder', array(
			'label' => 'kod placeholdera',
			'required' => true,
			'validators' => array('NotEmpty'),
		));

		$this->addElement('submit', 'submit', array(
			'label' => 'zapisz placeholder'
		));
	}

}
