<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

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
