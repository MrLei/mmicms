<?php
class Cms_Plugin_LogGrid extends Mmi_Grid {
	
	protected $_daoName = 'Cms_Model_Log_Dao';

	public function init() {

		$this->setOption('order', array('dateTime' => 'DESC'));

		$this->addColumn('text', 'dateTime', array(
			'label' => 'data i czas'
		));
		$this->addColumn('text', 'operation', array(
			'label' => 'operacja'
		));
		$this->addColumn('text', 'url', array(
			'label' => 'URL'
		));

		$this->addColumn('text', 'data', array(
			'label' => 'dane',
		));

		$this->addColumn('text', 'ip', array(
			'label' => 'adres IP'
		));
		$this->addColumn('checkbox', 'success', array(
			'label' => 'sukces',
		));

	}
}
