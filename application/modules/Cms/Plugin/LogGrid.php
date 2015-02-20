<?php

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
