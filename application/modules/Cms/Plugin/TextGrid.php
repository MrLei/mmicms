<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Cms\Plugin;

class TextGrid extends \Mmi\Grid {

	public function init() {

		$this->setQuery(\Cms\Model\Text\Dao::langQuery()
				->orderAscKey());

		$this->setOption('rows', 100);

		$this->addColumn('text', 'lang', array(
			'label' => 'język'
		));

		$this->addColumn('text', 'key', array(
			'label' => 'klucz',
		));

		$this->addColumn('text', 'content', array(
			'label' => 'treść',
			'sortable' => false,
			'seekable' => false
		));

		$this->addColumn('text', 'dateModify', array(
			'label' => 'data modyfikacji',
		));

		$this->addColumn('buttons', 'buttons', array(
			'label' => 'operacje'
		));
	}

}
