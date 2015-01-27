<?php

class Cms_Plugin_PageWidgetGrid extends Mmi_Grid {

	public function init() {

		$this->setQuery(Cms_Model_Page_Widget_Query::factory()
				->orderAscId());

		$this->addColumn('text', 'name', [
			'label' => 'Nazwa'
		]);

		$this->addColumn('custom', 'Object', [
			'label' => 'Moduł - Kontroler - Akcja',
			'value' => '{$rowData->module} - {$rowData->controller} - {$rowData->action}'
		]);
		
		$this->addColumn('text', 'params', [
			'label' => 'Domyślne parametry'
		]);

		$this->addColumn('checkbox', 'active', array(
			'label' => 'Aktywny'
		));

		$this->addColumn('buttons', 'buttons', array(
			'label' => 'Operacje'
		));
	}

}
