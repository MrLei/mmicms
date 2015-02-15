<?php

class Cms_Plugin_CronGrid extends Mmi_Grid {

	public function init() {
		
		$this->setQuery(Cms_Model_Cron_Query::factory());

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
