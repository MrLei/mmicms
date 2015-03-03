<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Cms\Plugin;

class AuthGrid extends \Mmi\Grid {

	public function init() {

		$this->setQuery(\Cms\Model\Auth\Query::factory());

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
