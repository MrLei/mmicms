<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Cms\Plugin;

class MailGrid extends \Mmi\Grid {

	public function init() {

		$this->setQuery(\Cms\Model\Mail\Query::factory()
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
