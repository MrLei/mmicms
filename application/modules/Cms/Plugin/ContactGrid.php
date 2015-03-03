<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Cms\Plugin;

class ContactGrid extends \Mmi\Grid {

	public function init() {

		$this->setQuery(\Cms\Model\Contact\Query::factory());

		$this->addColumn('custom', 'id', array(
			'label' => 'ticket',
			'value' => '#{$rowData->id}'
		));
		$this->addColumn('text', 'dateAdd', array(
			'label' => 'data dodania'
		));
		$this->addColumn('text', 'dateAdd', array(
			'label' => 'data dodania'
		));
		$this->addColumn('text', 'text', array(
			'label' => 'zapytanie'
		));
		$this->addColumn('text', 'email', array(
			'label' => 'e-mail'
		));

		$this->addColumn('text', 'uri', array(
			'label' => 'strona wejściowa'
		));

		$this->addColumn('text', 'ip', array(
			'label' => 'ip'
		));

		$this->addColumn('checkbox', 'active', array(
			'label' => 'czeka'
		));

		$this->addColumn('buttons', 'buttons', array(
			'label' => 'operacje',
			'links' => array(
				'delete' => \Mmi\Controller\Front::getInstance()->getView()->baseUrl . '/cms/admin-contact/delete/id/%id%',
				'edit' => \Mmi\Controller\Front::getInstance()->getView()->baseUrl . '/cms/admin-contact/edit/id/%id%'
			)
		));
	}

}
