<?php

class Stat_Plugin_LabelGrid extends Mmi_Grid {

	protected $_daoName = 'Stat_Model_Label_Dao';

	public function init() {

		$this->addColumn('text', 'object', array(
			'label' => 'klucz'
		));

		$this->addColumn('text', 'label', array(
			'label' => 'nazwa statystyki'
		));

		$this->addColumn('text', 'description', array(
			'label' => 'opis'
		));

		$this->addColumn('buttons', 'buttons', array(
			'label' => 'operacje',
			array('links' => array('remove' => null))
		));
	}

}
