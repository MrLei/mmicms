<?php

class Embed_Plugin_Grid extends Mmi_Grid {

	protected $_daoName = 'Embed_Model_Dao';

	public function init() {

		$this->setOption('locked', true);

		$this->addColumn('custom', 'embed_domain_id', array(
			'label' => 'kod',
			'value' => 'UC-{$rowData->embed_domain_id}-{$rowData->encodedId}'
		));

		$this->addColumn('text', 'module', array(
			'label' => 'moduł'
		));

		$this->addColumn('text', 'controller', array(
			'label' => 'kontroler'
		));

		$this->addColumn('text', 'action', array(
			'label' => 'akcja'
		));

		$this->addColumn('custom', 'params', array(
			'label' => 'parametry',
			'value' => '{php_print_r(php_unserialize($rowData->params))}'
		));

		$this->addColumn('text', 'width', array(
			'label' => 'szerokość (px)'
		));

		$this->addColumn('text', 'height', array(
			'label' => 'wysokość (px)'
		));

		$this->addColumn('checkbox', 'iframe', array(
			'label' => 'iframe'
		));

		$this->addColumn('checkbox', 'active', array(
			'label' => 'aktywna'
		));

		$this->addColumn('buttons', 'buttons', array(
			'label' => 'operacje'
		));
	}

}
