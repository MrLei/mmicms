<?php

class Cms_Plugin_ContainerGrid extends Mmi_Grid {

	protected $_daoName = 'Cms_Model_Container_Dao';

	public function init() {

		$this->addColumn('text', 'title', array(
			'label' => 'tytuł',
		));

		$this->addColumn('buttons', 'buttons', array(
			'label' => 'operacje'
		));
	}

}
