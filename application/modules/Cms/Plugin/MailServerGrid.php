<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Cms\Plugin;

class MailServerGrid extends \Mmi\Grid {

	public function init() {

		$this->setQuery(\Cms\Model\Mail\Server\Query::factory()
				->orderDescId());

		$this->addColumn('text', 'address', array(
			'label' => 'Adres serwera',
		));

		$this->addColumn('text', 'port', array(
			'label' => 'Port',
		));

		$this->addColumn('text', 'ssl', array(
			'label' => 'Szyfrowanie',
		));

		$this->addColumn('text', 'username', array(
			'label' => 'Użytkownik',
		));

		$this->addColumn('text', 'from', array(
			'label' => 'Domyślny nadawca',
		));

		$this->addColumn('text', 'dateAdd', array(
			'label' => 'Data dodania',
		));

		$this->addColumn('text', 'dateModify', array(
			'label' => 'Data modyfikacji',
		));

		$this->addColumn('buttons', 'buttons', array(
			'label' => 'operacje',
		));
	}

}
