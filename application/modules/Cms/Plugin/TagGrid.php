<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Cms\Plugin;

class TagGrid extends \Mmi\Grid {

	public function init() {

		$this->setQuery(\Cms\Model\Tag\Query::factory());
		$this->setOption('locked', true);

		$this->addColumn('text', 'tag', array(
			'label' => 'tag',
		));

		$this->addColumn('buttons', 'buttons', array(
			'label' => 'operacje'
		));
	}

}
