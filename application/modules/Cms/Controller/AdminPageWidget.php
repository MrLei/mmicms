<?php

class Cms_Controller_AdminPageWidget extends Mmi_Controller_Action {

	public function indexAction() {
		$this->view->widgets = Cms_Model_Page_Widget_Query::factory()->find();

		$widgetForm = new Cms_Form_Admin_Page_Widget();
		if ($widgetForm->isMine() && $widgetForm->isSaved()) {
			return $this->_helper->redirector('index', 'adminPageWidget', 'cms', array());
		}
	}

	public function deleteAction() {
		$this->getResponse()->setTypePlain();
		if (!($this->id > 0)) {
			return 0;
		}
		$widget = new Cms_Model_Page_Widget_Record($this->id);
		$widget->delete();
		return 1;
	}

	public function updateAction() {
		$msg = $this->view->getTranslate()->_('Zmiana właściwości nie powiodła się.');
		$this->getResponse()->setTypePlain();
		if (!($this->id)) {
			return $msg;
		}
		if (!($this->value)) {
			return $msg;
		}
		$params = explode('-', $this->id);
		if (count($params) != 2) {
			return $msg;
		}
		$model = new Cms_Model_Page_Widget_Record($params[1]);
		$model->active = $this->value;
		$model->save();

		return 1;
	}

}
