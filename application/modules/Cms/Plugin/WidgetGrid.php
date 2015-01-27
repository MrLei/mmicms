<?php

class Cms_Plugin_WidgetGrid extends Mmi_Grid {

	public function init() {

		$this->setQuery(Cms_Model_Page_Widget_Dao::activeQuery()
				->orderAscId());

		$this->addColumn('text', 'name', [
			'label' => 'Nazwa',
		]);

		$this->addColumn('custom', 'data', [
			'label' => 'Zawartość widgetów',
			'seekable' => false,
			'sortable' => false,
			'value' => '{if $rowData->isExistWidgetEdit($rowData->action)}<a class="button small" href="' . $this->_view->baseUrl . '/cms/adminWidget/%action%Edit/' . '">Przejdź</a>{/if}'
		]);
	}

}
