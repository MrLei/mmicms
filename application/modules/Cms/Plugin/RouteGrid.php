<?php

namespace Cms\Plugin;
class RouteGrid extends \Mmi\Grid {

	public function init() {

		$this->setQuery(Cms\Model\Route\Query::factory()
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
