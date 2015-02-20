<?php

namespace Cms\Plugin;
class CommentGrid extends \Mmi\Grid {

	public function init() {
		
		$this->setQuery(\Cms\Model\Comment\Query::factory());

		$this->addColumn('text', 'dateAdd', array(
			'label' => 'data dodania'
		));
		$this->addColumn('text', 'text', array(
			'label' => 'komentarz'
		));
		$this->addColumn('text', 'signature', array(
			'label' => 'podpis'
		));

		$this->addColumn('text', 'object', array(
			'label' => 'zasób'
		));

		$this->addColumn('text', 'objectId', array(
			'label' => 'id zasobu'
		));

		$this->addColumn('buttons', 'buttons', array(
			'label' => 'operacje',
			'links' => array(
				'edit' => null
			)
		));
	}

}
