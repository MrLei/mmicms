<?php

namespace Cms\Controller\Admin;

class PageWidget extends \MmiCms\Controller\Admin {

	public function indexAction() {
		$this->view->grid = new \Cms\Plugin\PageWidgetGrid();
	}

	public function editAction() {
		$widget = Cms\Model\Page\Widget\Dao::findPk($this->id);
		
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
		$record = Cms\Model\Page\Widget\Dao::findPk($this->id);
		if ($record !== null && $record->delete()) {
			$this->_helper->messenger('Widget zostal usuniety');
		}
		$this->_helper->redirector('index', 'admin-pageWidget', 'cms', array(), true);
	}

}
