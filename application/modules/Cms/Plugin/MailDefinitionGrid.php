<?php

class Cms_Plugin_MailDefinitionGrid extends Mmi_Grid {

	public function init() {
		
		$this->setQuery(Cms_Model_Mail_Definition_Dao::langQuery());

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
