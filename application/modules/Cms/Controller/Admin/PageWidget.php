<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Cms\Controller\Admin;

class PageWidget extends \MmiCms\Controller\Admin {

	public function indexAction() {
		$this->view->grid = new \Cms\Plugin\PageWidgetGrid();
	}

	public function editAction() {
		$widget = \Cms\Model\Page\Widget\Query::factory()->findPk($this->id);

		if ($widget !== null) {
			$this->widget = ucfirst($widget->module) . ':' . ucfirst($widget->controller) . ':' . $widget->action;
		}

		$widgetForm = new \Cms\Form\Admin\Page\Widget($widget, array(
			'widget' => $this->widget
		));

		if ($widgetForm->isSaved()) {
			$this->_helper->messenger('Widget zapisany poprawnie');
			$this->_helper->redirector('index', 'admin-pageWidget', 'cms', array(), true);
		}
	}

	public function deleteAction() {
		$record = \Cms\Model\Page\Widget\Query::factory()->findPk($this->id);
		if ($record !== null && $record->delete()) {
			$this->_helper->messenger('Widget zostal usuniety');
		}
		$this->_helper->redirector('index', 'admin-pageWidget', 'cms', array(), true);
	}

}
