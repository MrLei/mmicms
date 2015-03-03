<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Cms\Plugin;

class ContactOptionGrid extends \Mmi\Grid {

	public function init() {

		$this->setQuery(\Cms\Model\Contact\Option\Query::factory());

		$this->addColumn('text', 'name', array(
			'label' => 'temat pytania'
		));

		$this->addColumn('text', 'sendTo', array(
			'label' => 'prześlij na e-mail'
		));

		$this->addColumn('buttons', 'buttons', array(
			'label' => 'operacjse',
			'links' => array(
				'edit' => $this->_view->url(array('id' => '%id%', 'action' => 'editSubject')),
				'delete' => $this->_view->url(array('id' => '%id%', 'action' => 'deleteSubject')),
			)
		));
	}

}
