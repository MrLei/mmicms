<?php

namespace Cms\Plugin;
class WidgetGrid extends \Mmi\Grid {

	public function init() {

		$this->setQuery(Cms\Model\Page\Widget\Dao::activeQuery()
				->orderAscId());

		$this->addColumn('text', 'name', [
			'label' => 'Nazwa',
		]);

		$this->addColumn('custom', 'data', [
			'label' => 'Zawartość widgetów',
			'seekable' => false,
			'sortable' => false,
			'value' => '{if $rowData->isExistWidgetEdit($rowData->action)}<a class="button small" href="' . $this->_view->baseUrl . '/cms/admin-widget/%action%Edit/' . '">Przejdź</a>{/if}'
		]);
	}

}
