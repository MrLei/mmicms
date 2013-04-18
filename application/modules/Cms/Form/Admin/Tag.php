<?php

class Cms_Form_Admin_Tag extends Mmi_Form {

	protected $_recordName = 'Cms_Model_Tag_Record';

	public function init() {
		
		$this->addElement('text', 'tag', array(
			'label' => 'tag',
			'required' => true,
			'filters' => array('StringTrim'),
			'validators' => array(
				array('validator' => 'StringLength', 'options' => array(2, 64)),
			),
		));
		
		$this->addElement('submit', 'submit', array(
			'ignore' => true,
			'label' => 'zapisz',
		));
		
	}
	
}