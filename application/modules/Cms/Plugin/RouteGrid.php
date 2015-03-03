<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Cms\Plugin;

class RouteGrid extends \Mmi\Grid {

	public function init() {

		$this->setQuery(\Cms\Model\Route\Query::factory()
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
