<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Cms\Plugin;

class MailDefinitionGrid extends \Mmi\Grid {

	public function init() {

		$this->setQuery(\Cms\Model\Mail\Definition\Dao::langQuery());

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
