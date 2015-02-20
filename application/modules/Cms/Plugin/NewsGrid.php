<?php

class Cms_Plugin_NewsGrid extends Mmi_Grid {

	public function init() {

		$this->setQuery(Cms_Model_News_Query::factory());

		$this->setOption('locked', true);

		$this->addColumn('text', 'lang', array(
			'label' => 'język'
		));

		$this->addColumn('text', 'dateAdd', array(
			'label' => 'data dodania'
		));

		$this->addColumn('text', 'dateModify', array(
			'label' => 'data modyfikacji'
		));

		$this->addColumn('text', 'title', array(
			'label' => 'tytuł'
		));

		$this->addColumn('text', 'text', array(
			'sortable' => false,
			'label' => 'treść aktualności'
		));

		$this->addColumn('buttons', 'buttons', array(
			'label' => 'operacje'
		));
	}

}
