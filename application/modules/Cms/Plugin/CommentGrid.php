<?php

class Cms_Plugin_CommentGrid extends Mmi_Grid {

	protected $_daoName = 'Cms_Model_Comment_Dao';

	public function init() {

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
