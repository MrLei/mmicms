<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Cms\Plugin;

class PageWidgetGrid extends \Mmi\Grid {

	public function init() {

		$this->setQuery(\Cms\Model\Page\Widget\Query::factory()
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
