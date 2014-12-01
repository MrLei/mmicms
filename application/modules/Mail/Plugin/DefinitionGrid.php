<?php

class Mail_Plugin_DefinitionGrid extends Mmi_Grid {

	protected $_daoName = 'Mail_Model_Definition_Dao';
	protected $_daoGetMethod = 'findLang';
	protected $_daoCountMethod = 'countLang';

	public function init() {

		$this->addColumn('text', 'lang', array(
			'label' => 'język'
		));

		$this->addColumn('text', 'name', array(
			'label' => 'nazwa'
		));

		$this->addColumn('checkbox', 'html', array(
			'label' => 'HTML'
		));

		$this->addColumn('text', 'subject', array(
			'label' => 'temat'
		));

		$this->addColumn('text', 'fromName', array(
			'label' => 'nazwa od'
		));

		$this->addColumn('text', 'replyTo', array(
			'label' => 'odpowiedz'
		));

		$this->addColumn('text', 'mailServerId', array(
			'label' => 'id połączenia'
		));

		$this->addColumn('text', 'dateAdd', array(
			'label' => 'data dodania'
		));

		$this->addColumn('text', 'dateModify', array(
			'label' => 'data modyfikacji'
		));

		$this->addColumn('checkbox', 'active', array(
			'label' => 'aktywny'
		));

		$this->addColumn('buttons', 'buttons', array(
			'label' => 'operacje'
		));
	}

}
