<?php

namespace Cms\Plugin;
class TagGrid extends \Mmi\Grid {

	public function init() {
		
		$this->setQuery(Cms\Model\Tag\Query::factory());
		$this->setOption('locked', true);

		$this->addColumn('text', 'tag', array(
			'label' => 'tag',
		));

		$this->addColumn('buttons', 'buttons', array(
			'label' => 'operacje'
		));
	}

}
