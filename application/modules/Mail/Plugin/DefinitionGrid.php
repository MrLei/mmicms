<?php

class Mail_Plugin_DefinitionGrid extends Mmi_Grid {

	protected $_daoName = 'Mail_Model_Definition_Dao';

	public function init() {

		$this->setOption('locked', true);

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

		$this->addColumn('text', 'replyTo',	array(
			'label' => 'odpowiedz'
		));

		$this->addColumn('text', 'mail_server_id', array(
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
