<?php

class Cms_Controller_AdminRoute extends MmiCms_Controller_Admin {

	public function indexAction() {
		$this->view->grid = new Cms_Plugin_RouteGrid();
	}

	public function editAction() {
		$form = new Cms_Form_Admin_Route($this->_getParam('id'));
		if ($form->isSaved()) {
			$this->_helper->messenger('Poprawnie zapisano trasę', true);
			$this->_helper->redirector('index', 'adminRoute', 'cms', array(), true);
		}
	}

	public function deleteAction() {
		$text = new Cms_Model_Route_Record($this->_getParam('id'));
		if ($text->delete()) {
			$this->_helper->messenger('Poprawnie skasowano trasę');
		}
		$this->_helper->redirector('index', 'adminRoute', 'cms', array(), true);
	}

}