<?php

class Embed_Plugin_DomainGrid extends Mmi_Grid {

	protected $_daoName = 'Embed_Model_Domain_Dao';

	public function init() {

		$this->setOption('locked', true);

		$this->addColumn('text', 'name', array(
			'label' => 'nazwa domeny',
		));

		$this->addColumn('buttons', 'buttons', array(
			'label' => 'operacje'
		));
	}

}
