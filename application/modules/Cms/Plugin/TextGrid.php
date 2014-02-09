<?php
class Cms_Plugin_TextGrid extends Mmi_Grid {

	protected $_daoName = 'Cms_Model_Text_Dao';

	public function init() {

		$q = new Mmi_Dao_Query();
		$this->setInitialQuery($q->orderAsc('key'));
		$this->setOption('rows', 100);
		
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
