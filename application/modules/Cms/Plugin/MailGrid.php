<?php

class Cms_Plugin_MailGrid extends Mmi_Grid {

	public function init() {
		
		$this->setQuery(Cms_Model_Mail_Query::factory()
			->orderDescId());

		$this->addColumn('checkbox', 'active', array(
			'label' => 'Wysłany',
		));

		$this->addColumn('text', 'dateAdd', array(
			'label' => 'Data dodania',
		));

		$this->addColumn('text', 'dateSent', array(
			'label' => 'Data wysłania',
		));

		$this->addColumn('text', 'to', array(
			'label' => 'Do',
		));

		$this->addColumn('text', 'subject', array(
			'label' => 'Temat',
		));

		$this->addColumn('text', 'fromName', array(
			'label' => 'Od',
		));

		$this->addColumn('buttons', 'buttons', array(
			'label' => 'operacje',
			'links' => array(
				'edit' => null
			)
		));
	}

}
