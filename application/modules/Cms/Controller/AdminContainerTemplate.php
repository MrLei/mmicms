<?php

class Cms_Controller_AdminContainerTemplate extends MmiCms_Controller_Admin {

	public function indexAction() {
		$this->view->grid = new Cms_Plugin_ContainerTemplateGrid();
	}

	public function editAction() {
		$form = new Cms_Form_Admin_Container_Template($this->_getParam('id'));
		if ($form->isSaved()) {
			$this->_helper->messenger('Szablon zapisany poprawnie', true);
			$this->_helper->redirector('index', 'adminContainerTemplate', 'cms', array(), true);
		}
	}

	public function deleteAction() {
		$record = new Cms_Model_Container_Template_Record($this->_getParam('id'));
		if ($record->delete()) {
			$this->_helper->messenger('Poprawnie usunięto szablon', true);
		}
		$this->_helper->redirector('index', 'adminContainerTemplate', 'cms', array(), true);
	}

}
