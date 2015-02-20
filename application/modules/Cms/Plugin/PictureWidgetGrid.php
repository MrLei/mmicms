<?php

namespace Cms\Plugin;

class PictureWidgetGrid extends \Mmi\Grid {

	public function init() {

		$this->setQuery(\Cms\Model\Widget\Picture\Query::factory()
				->join('cms_file')->on('id', 'objectId')
				->where('object', 'cms_file')->equals('cmswidgetpicture'));

		$this->addColumn('text', 'id', [
			'label' => 'ID zdjecia'
		]);

		$this->addColumn('custom', 'picture', [
			'label' => 'Zdjecie',
			'seekable' => 'false',
			'sortable' => 'false',
			'value' => '<img src="{$rowData->getJoined(\'cms_file\')->getUrl(\'scale\',\'150\')}">'
		]);

		$this->addColumn('buttons', 'buttons', [
			'label' => 'Operacje',
			'links' => [
				'edit' => $this->_view->url(array('id' => '%id%', 'action' => 'pictureWidgetEdit', 'controller' => 'admin-widget', 'module' => 'cms')),
				'delete' => $this->_view->url(array('id' => '%id%', 'action' => 'pictureWidgetDelete', 'controller' => 'admin-widget', 'module' => 'cms'))
			]
		]);
	}

}
