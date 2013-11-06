<?php

class Cms_Plugin_TagGrid extends Mmi_Grid {

	protected $_daoName = 'Cms_Model_Tag_Dao';

	public function init() {
		$this->setOption('locked', true);
		
		$this->addColumn('text', 'tag', array(
			'label' => 'tag',
		));
		
		$this->addColumn('buttons', 'buttons', array(
			'label' => 'operacje'
		));
	}

}
