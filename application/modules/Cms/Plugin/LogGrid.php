<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Cms\Plugin;

class LogGrid extends \Mmi\Grid {

	public function init() {

		$this->setQuery(\Cms\Model\Log\Query::factory()
				->orderDescDateTime());

		$this->addColumn('text', 'dateTime', array(
			'label' => 'data i czas'
		));
		$this->addColumn('text', 'operation', array(
			'label' => 'operacja'
		));
		$this->addColumn('text', 'url', array(
			'label' => 'URL'
		));

		$this->addColumn('text', 'data', array(
			'label' => 'dane',
		));

		$this->addColumn('text', 'ip', array(
			'label' => 'adres IP'
		));
		$this->addColumn('checkbox', 'success', array(
			'label' => 'sukces',
		));
	}

}
