<?php

class Payment_Form_Admin_Config extends Mmi_Form {

	protected $_modelName = 'Payment_Model_Config';

	public function init() {

		$this->addElement('text', 'name', array(
			'label' => 'nazwa',
			'description' => 'unikalna nazwa punktu płatności'
		));

		$this->addElement('text', 'shopId', array(
			'label' => 'identyfikator sklepu'
		));

		$this->addElement('text', 'transactionKey', array(
			'label' => 'klucz transakcyjny'
		));

		$this->addElement('text', 'key1', array(
			'label' => 'klucz 1'
		));

		$this->addElement('text', 'key2', array(
			'label' => 'klucz 2'
		));
		
		$this->addElement('submit', 'submit', array(
			'label' => 'zapisz'
		));

	}

}