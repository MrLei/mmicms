<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

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
