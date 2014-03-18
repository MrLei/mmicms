<?php

class Cms_Plugin_ContactGrid extends Mmi_Grid {
	
	protected $_daoName = 'Cms_Model_Contact_Dao';
	protected $_daoGetMethod = 'findDefaults';
	protected $_daoCountMethod = 'countDefaults';

	public function init() {

		$this->addColumn('custom', 'id', array(
				'label' => 'ticket',
				'value' => '#{$rowData->id}'
		));
		$this->addColumn('text', 'dateAdd', array(
				'label' => 'data dodania'
		));
		$this->addColumn('text', 'dateAdd', array(
				'label' => 'data dodania'
		));
		$this->addColumn('text', 'text', array(
				'label' => 'zapytanie'
		));
		$this->addColumn('text', 'email', array(
				'label' => 'e-mail'
		));

		$this->addColumn('text', 'uri', array(
				'label' => 'strona wejściowa'
		));

		$this->addColumn('text', 'ip', array(
				'label' => 'ip'
		));

		$this->addColumn('checkbox', 'active', array(
				'label' => 'czeka'
		));

		$this->addColumn('buttons', 'buttons', array(
			'label' => 'operacje',
			'links' => array(
				'delete' => Mmi_Controller_Front::getInstance()->getView()->baseUrl . '/cms/adminContact/delete/id/%id%',
				'edit' => Mmi_Controller_Front::getInstance()->getView()->baseUrl . '/cms/adminContact/edit/id/%id%'
			)

		));

	}
}
