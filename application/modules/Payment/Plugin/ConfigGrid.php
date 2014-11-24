<?php

class Payment_Plugin_ConfigGrid extends Mmi_Grid {

	protected $_modelName = 'Payment_Model_Config';

	public function init() {

		$this->addColumn('text', 'name', array(
			'label' => 'nazwa'
		));

		$this->addColumn('text', 'shopId', array(
			'label' => 'identyfikator sklepu'
		));

		$this->addColumn('text', 'transactionKey', array(
			'label' => 'klucz autoryzacji transakcji'
		));

		$this->addColumn('text', 'key1', array(
			'label' => 'klucz 1'
		));

		$this->addColumn('text', 'key2', array(
			'label' => 'klucz 2'
		));

		$this->addColumn('buttons', 'buttons', array(
			'label' => 'operacje'
		));
	}

}
