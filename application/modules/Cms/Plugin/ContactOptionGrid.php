<?php

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
