<?php

class Cms_Plugin_ContainerGrid extends Mmi_Grid {

	public function init() {
		
		$this->setQuery(Cms_Model_Container_Query::factory());

		$this->addColumn('text', 'title', array(
			'label' => 'tytuł',
		));

		$this->addColumn('buttons', 'buttons', array(
			'label' => 'operacje'
		));
	}

}
