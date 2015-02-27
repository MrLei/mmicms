<?php

namespace Cms\Plugin;

class PageGrid extends \Mmi\Grid {

	public function init() {

		$this->setQuery(\Cms\Model\Page\Query::factory()
				->join('cms_navigation')->on('cms_navigation_id')
				->orderAscId());

		$this->addColumn('text', 'name', array(
			'label' => 'nazwa',
		));

		$this->addColumn('text', 'cms_navigation:title', array(
			'label' => 'tytuł',
		));

		$this->addColumn('text', 'dateAdd', array(
			'label' => 'data dodania',
		));

		$this->addColumn('text', 'dateModify', array(
			'label' => 'data zmiany',
		));

		$this->addColumn('checkbox', 'active', array(
			'label' => 'aktywna',
		));

		$this->addColumn('buttons', 'buttons', array(
			'label' => 'operacje'
		));
	}

}
