<?php

class Cms_Plugin_TextWidgetGrid extends Mmi_Grid {

	public function init() {

		$this->setQuery(Cms_Model_Widget_Text_Query::factory()
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
				'edit' => $this->_view->url(array('id' => '%id%', 'action' => 'textWidgetEdit', 'controller' => 'adminWidget', 'module' => 'cms')),
				'delete' => $this->_view->url(array('id' => '%id%', 'action' => 'textWidgetDelete', 'controller' => 'adminWidget', 'module' => 'cms'))
			]
		]);
	}

}
