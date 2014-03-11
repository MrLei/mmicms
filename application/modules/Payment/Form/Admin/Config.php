<?php

class Payment_Form_Admin_Config extends Mmi_Form {

	protected $_modelName = 'Payment_Model_Config';

	public function init() {

		$this->addElementText('name')
			->setLabel('nazwa')
			->setDescription('unikalna nazwa punktu płatności');

		$this->addElementText('shopId')
			->setLabel('identyfikator sklepu');

		$this->addElementText('transactionKey')
			->setLabel('klucz transakcyjny');

		$this->addElementText('key1')
			->setLabel('klucz 1');

		$this->addElementText('key2')
			->setLabel('klucz 2');

		$this->addElementSubmit('submit')
			->setLabel('zapisz');
	}

}
