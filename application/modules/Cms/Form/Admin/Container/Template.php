<?php

class Cms_Form_Admin_Container_Template extends Mmi_Form {

	protected $_recordName = 'Cms_Model_Container_Template_Record';

	public function init() {

		$this->addElement('text', 'name', array(
			'label' => 'nazwa szablonu',
			'required' => true,
			'validators' => array('NotEmpty'),
		));
		
		$this->addElement('textarea', 'text', array(
			'label' => 'kod szablonu',
		));

		$this->addElement('submit', 'submit', array(
			'label' => 'zapisz szablon'
		));
	}

}
