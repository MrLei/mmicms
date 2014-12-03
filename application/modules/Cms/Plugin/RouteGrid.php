<?php

class Cms_Plugin_RouteGrid extends Mmi_Grid {

	public function init() {

		$this->setQuery(Cms_Model_Route_Query::factory()
			->orderAscOrder());
		
		$this->setOption('rows', 100);

		$this->addColumn('text', 'pattern', array(
			'label' => 'wzorzec',
		));

		$this->addColumn('text', 'replace', array(
			'label' => 'tabela zamian',
		));

		$this->addColumn('text', 'default', array(
			'label' => 'tabela wartości domyślnych',
		));

		$this->addColumn('text', 'order', array(
			'label' => 'indeks kolejności',
		));

		$this->addColumn('checkbox', 'active', array(
			'label' => 'aktywna',
		));

		$this->addColumn('buttons', 'buttons', array(
			'label' => 'operacje'
		));
	}

}
