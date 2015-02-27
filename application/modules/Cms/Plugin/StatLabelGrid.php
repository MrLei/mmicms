<?php

namespace Cms\Plugin;

class StatLabelGrid extends \Mmi\Grid {

	public function init() {

		$this->setQuery(\Cms\Model\Stat\Label\Query::factory());

		$this->addColumn('text', 'object', array(
			'label' => 'klucz'
		));

		$this->addColumn('text', 'label', array(
			'label' => 'nazwa statystyki'
		));

		$this->addColumn('text', 'description', array(
			'label' => 'opis'
		));

		$this->addColumn('buttons', 'buttons', array(
			'label' => 'operacje',
			array('links' => array('remove' => null))
		));
	}

}
