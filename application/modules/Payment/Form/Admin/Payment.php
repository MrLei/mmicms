<?php

class Payment_Form_Admin_Payment extends Mmi_Form {

	protected $_modelName = 'Payment_Model_Payment';

	public function init() {

		$this->addElementText('text')
			->setLabel('opis płatności');

		$this->addElementText('value')
			->setLabel('wartość');
	}

}
