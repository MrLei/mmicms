<?php

class Cms_Plugin_StatLabelGrid extends Mmi_Grid {

	public function init() {
		
		$this->setQuery(Cms_Model_Stat_Label_Query::factory());

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
