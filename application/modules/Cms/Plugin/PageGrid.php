<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

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
