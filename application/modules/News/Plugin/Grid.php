<?php

class News_Plugin_Grid extends Mmi_Grid {

	protected $_daoName = 'News_Model_Dao';
	protected $_daoGetMethod = 'findLang';
	protected $_daoCountMethod = 'countLang';

	public function init() {

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
			'label' => 'treść aktualności'
		));

		$this->addColumn('buttons', 'buttons', array(
			'label' => 'operacje'
		));

	}
}
