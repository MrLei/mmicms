<?php

class Cms_Plugin_TextGrid extends Mmi_Grid {

	public function init() {
		
		$this->setQuery(Cms_Model_Text_Dao::langQuery()
			->orderAscKey());

		$this->setOption('rows', 100);

		$this->addColumn('text', 'lang', array(
			'label' => 'język'
		));

		$this->addColumn('text', 'key', array(
			'label' => 'klucz',
		));

		$this->addColumn('text', 'content', array(
			'label' => 'treść',
			'sortable' => false,
			'seekable' => false
		));

		$this->addColumn('text', 'dateModify', array(
			'label' => 'data modyfikacji',
		));

		$this->addColumn('buttons', 'buttons', array(
			'label' => 'operacje'
		));
	}

}
