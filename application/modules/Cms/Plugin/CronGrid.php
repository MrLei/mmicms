<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Cms\Plugin;

class CronGrid extends \Mmi\Grid {

	public function init() {

		$this->setQuery(\Cms\Model\Cron\Query::factory());

		$this->addColumn('text', 'name', array(
			'label' => 'Nazwa',
		));

		$this->addColumn('text', 'description', array(
			'label' => 'Opis',
		));

		$this->addColumn('custom', 'Cron', array(
			'label' => 'Cron',
			'value' => '{$rowData->minute} {$rowData->hour} {$rowData->dayOfMonth} {$rowData->month} {$rowData->dayOfWeek}'
		));
		$this->addColumn('custom', 'Object', array(
			'label' => 'Wywołanie',
			'value' => '{$rowData->module}: {$rowData->controller} - {$rowData->action}'
		));
		$this->addColumn('text', 'dateAdd', array(
			'label' => 'Data dodania',
		));
		$this->addColumn('text', 'dateLastExecute', array(
			'label' => 'Ostatnie wywołanie',
		));

		$this->addColumn('checkbox', 'active', array(
			'label' => 'Włączony',
		));

		$this->addColumn('buttons', 'buttons', array(
			'label' => 'operacje',
		));
	}

}
