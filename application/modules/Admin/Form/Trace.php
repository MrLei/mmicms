<?php

class Admin_Form_Trace extends Mmi_Form {

	public function init() {
		$this->addElement('textarea', 'trace', array(
			'label' => 'Ślad'
		));

		$this->addElement('submit', 'login', array(
			'label' => 'Dekoduj'
		));
	}

}