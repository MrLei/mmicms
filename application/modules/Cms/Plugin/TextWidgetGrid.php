<?php

namespace Cms\Plugin;

class TextWidgetGrid extends \Mmi\Grid {

	public function init() {

		$this->setQuery(Cms\Model\Widget\Text\Query::factory()
				->orderAscId());

		$this->addColumn('text', 'id', [
			'label' => 'ID zawartości'
		]);

		$this->addColumn('text', 'data', [
			'label' => 'Zawartość'
		]);

		$this->addColumn('buttons', 'buttons', [
			'label' => 'Operacje',
			'links' => [
				'edit' => $this->_view->url(array('id' => '%id%', 'action' => 'textWidgetEdit', 'controller' => 'admin-widget', 'module' => 'cms')),
				'delete' => $this->_view->url(array('id' => '%id%', 'action' => 'textWidgetDelete', 'controller' => 'admin-widget', 'module' => 'cms'))
			]
		]);
	}

}
