<?php

class Cms_Plugin_AuthGrid extends Mmi_Grid {

	public function init() {
		
		$this->setQuery(Cms_Model_Auth_Query::factory());

		$this->setOption('locked', true);

		$this->addColumn('text', 'username', array(
			'label' => 'nazwa użytkownika'
		));

		$this->addColumn('text', 'email', array(
			'label' => 'e-mail'
		));

		$this->addColumn('text', 'lastLog', array(
			'label' => 'ostatnio zalogowany'
		));

		$this->addColumn('text', 'lastIp', array(
			'label' => 'ostatni IP'
		));

		$this->addColumn('text', 'lastFailLog', array(
			'label' => 'błędne logowanie'
		));

		$this->addColumn('text', 'lastFailIp', array(
			'label' => 'IP błędnego logowania'
		));

		$this->addColumn('checkbox', 'active', array(
			'label' => 'aktywny'
		));

		$this->addColumn('buttons', 'buttons', array(
			'label' => 'operacje'
		));
	}

}
