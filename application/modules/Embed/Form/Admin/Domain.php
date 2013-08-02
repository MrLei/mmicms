<?php

class Embed_Form_Admin_Domain extends Mmi_Form {

	protected $_recordName = 'Embed_Model_Domain_Record';

	public function init() {

		$this->addElement('text', 'name', array(
			'label' => 'Nazwa domeny',
			'required' => true
		));

		$this->addElement('submit', 'submit', array(
			'label' => 'Zapisz'
		));
	}

}