<?php

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
