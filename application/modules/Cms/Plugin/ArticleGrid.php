<?php
class Cms_Plugin_ArticleGrid extends Mmi_Grid {

	protected $_daoName = 'Cms_Model_Article_Dao';

	public function init() {
		$this->setOption('locked', true);
		$this->addColumn('text', 'title', array(
			'label' => 'tytuł',
		));

		$this->addColumn('text', 'text', array(
			'label' => 'treść',
			'sortable' => false,
			'seekable' => false
		));

		$this->addColumn('text', 'dateAdd', array(
			'label' => 'data dodania'
		));

		$this->addColumn('text', 'dateModify', array(
			'label' => 'data modyfikacji'
		));

		$this->addColumn('buttons', 'buttons', array(
			'label' => 'operacje'
		));
	}

}
