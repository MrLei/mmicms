<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Cms\Plugin;

class ArticleGrid extends \Mmi\Grid {

	public function init() {

		$this->setQuery(\Cms\Model\Article\Query::factory());

		$this->addColumn('text', 'title', array(
			'label' => 'tytuł',
		));

		$this->addColumn('text', 'text', array(
			'label' => 'treść',
			'sortable' => false,
			'seekable' => false
		));

		$this->addColumn('text', 'dateAdd', array(
			'label' => 'data dodania'
		));

		$this->addColumn('text', 'dateModify', array(
			'label' => 'data modyfikacji'
		));

		$this->addColumn('buttons', 'buttons', array(
			'label' => 'operacje'
		));
	}

}
