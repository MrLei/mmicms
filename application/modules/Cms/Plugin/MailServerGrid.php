<?php

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
