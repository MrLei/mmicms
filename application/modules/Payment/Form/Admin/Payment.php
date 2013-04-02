<?php

class Payment_Form_Admin_Payment extends Mmi_Form {

	protected $_modelName = 'Payment_Model_Payment';

	public function init() {

		$this->addElement('text', 'text', array(
			'label' => 'opis płatności'
		));

		$this->addElement('text', 'value', array(
			'label' => 'wartość'
		));

	}
	
}