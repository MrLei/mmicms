<?php

class Cms_Controller_Admin_PageWidget extends Mmi_Controller_Action {

	public function indexAction() {
		$this->view->grid = new Cms_Plugin_PageWidgetGrid();
	}

	public function editAction() {
		$widget = Cms_Model_Page_Widget_Dao::findPk($this->id);
		
		if ($widget !== null) {
			$this->widget = ucfirst($widget->module) . ':' . ucfirst($widget->controller) . ':' . $widget->action;
		}
		
		$widgetForm = new Cms_Form_Admin_Page_Widget($widget, array(
			'widget' => $this->widget
		));

		if ($widgetForm->isSaved()) {
			$this->_helper->messenger('Widget zapisany poprawnie');
			$this->_helper->redirector('index', 'admin-pageWidget', 'cms', array(), true);
		}
	}

	public function deleteAction() {
		$record = Cms_Model_Page_Widget_Dao::findPk($this->id);
		if ($record !== null && $record->delete()) {
			$this->_helper->messenger('Widget zostal usuniety');
		}
		$this->_helper->redirector('index', 'admin-pageWidget', 'cms', array(), true);
	}

}
