<?php

class Cms_Controller_AdminContainer extends MmiCms_Controller_Admin {

	public function indexAction() {
		$this->view->grid = new Cms_Plugin_ContainerGrid();
	}

	public function editAction() {
		$form = new Cms_Form_Admin_Container($this->_getParam('id'));
		if ($form->isSaved()) {
			$this->_helper->messenger('Kontener zapisany poprawnie', true);
			$this->_helper->redirector('index', 'adminContainer', 'cms', array(), true);
		}
	}

	public function deleteAction() {
		$record = new Cms_Model_Container_Record($this->_getParam('id'));
		if ($record->delete()) {
			$this->_helper->messenger('Poprawnie usunięto kontener', true);
		}
		$this->_helper->redirector('index', 'adminContainer', 'cms', array(), true);
	}

}
