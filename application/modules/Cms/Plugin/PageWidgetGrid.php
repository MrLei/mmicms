<?php

class Cms_Plugin_PageWidgetGrid extends Mmi_Grid {

	public function init() {

		$this->setQuery(Cms_Model_Page_Widget_Query::factory()
				->orderAscId());

		$this->addColumn('text', 'name', array(
			'label' => 'Nazwa',
		));

		$this->addColumn('text', 'module', array(
			'label' => 'Moduł'
		));

		$this->addColumn('text', 'controller', array(
			'label' => 'Kontroler'
		));

		$this->addColumn('text', 'action', array(
			'label' => 'Akcja'
		));

		$this->addColumn('text', 'params', array(
			'label' => 'Parametry'
		));

		$this->addColumn('checkbox', 'active', array(
			'label' => 'Aktywny'
		));

		$this->addColumn('buttons', 'buttons', array(
			'label' => 'Operacje'
		));
	}

}
