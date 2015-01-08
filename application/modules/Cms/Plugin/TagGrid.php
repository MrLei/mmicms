<?php

class Cms_Plugin_TagGrid extends Mmi_Grid {

	public function init() {
		
		$this->setQuery(Cms_Model_Tag_Query::factory());
		$this->setOption('locked', true);

		$this->addColumn('text', 'tag', array(
			'label' => 'tag',
		));

		$this->addColumn('buttons', 'buttons', array(
			'label' => 'operacje'
		));
	}

}
