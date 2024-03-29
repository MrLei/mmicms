<?php

class Cms_Plugin_ContactOptionGrid extends Mmi_Grid {

	public function init() {
		
		$this->setQuery(Cms_Model_Contact_Option_Query::factory());

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
