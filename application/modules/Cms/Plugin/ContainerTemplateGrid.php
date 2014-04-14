<?php
class Cms_Plugin_ContainerTemplateGrid extends Mmi_Grid {

	protected $_daoName = 'Cms_Model_Container_Template_Dao';

	public function init() {

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
