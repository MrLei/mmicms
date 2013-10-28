<?php

class Cms_Form_Admin_Container_Template extends Mmi_Form {

	protected $_recordName = 'Cms_Model_Container_Template_Record';

	public function init() {

		$this->addElement('text', 'name', array(
			'label' => 'nazwa szablonu',
			'required' => true,
			'validators' => array('NotEmpty'),
		));

		$this->addElement('text', 'path', array(
			'label' => 'ścieżka szablonu',
			'description' => '/skin-name/path-to-template.tpl',
			'required' => true,
			'validators' => array('NotEmpty'),
		));

		$this->addElement('submit', 'submit', array(
			'label' => 'zapisz szablon'
		));
	}

}
