<?php

class Cms_Plugin_ContainerTemplateGrid extends Mmi_Grid {

	public function init() {
		
		$this->setQuery(Cms_Model_Container_Template_Query::factory());

		$this->addColumn('text', 'name', array(
			'label' => 'nazwa szablonu',
		));

		$this->addColumn('text', 'path', array(
			'label' => 'ścieżka do szablonu',
		));

		$this->addColumn('buttons', 'buttons', array(
			'label' => 'operacje'
		));
	}

}
