<?php

class Cms_Form_Admin_Role extends Mmi_Form {

	protected $_recordName = 'Cms_Model_Role_Record';

	public function init() {

		$this->addElement('text', 'role', array(
			'validators' => array(
				array('validator' => 'StringLength', 'options' => array(3, 64)),
			)
		));

		$this->addElement('submit', 'submit', array(
			'label' => 'utwórz rolę'
		));

	}

}
