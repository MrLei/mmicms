<?php

class Payment_Plugin_Grid extends Mmi_Grid {

	protected $_modelName = 'Payment_Model_Payment';

	public function init() {

		$this->addColumn('text', 'text', array(
			'label' => 'opis'
		));

		$this->addColumn('text', 'value', array(
			'label' => 'kwota transakcji'
		));

		$this->addColumn('text', 'ip', array(
			'label' => 'ip zamówienia'
		));

		$this->addColumn('text', 'sessionId', array(
			'label' => 'sessionId'
		));

		$this->addColumn('text', 'dateAdd', array(
			'label' => 'data utworzenia'
		));

		$this->addColumn('text', 'dateEnd', array(
			'label' => 'data zakończenia'
		));

		$this->addColumn('select', 'status', array(
			'multiOptions' => array(
				0 => 'dodana',
				1 => 'status zmieniony',
				2 => 'anulowana',
				3 => 'zaakceptowana',
				4 => 'zakończona',
			),
			'label' => 'status'
		));
		
		$this->addColumn('buttons', 'buttons', array(
			'label' => 'operacje'
		));
	}

}