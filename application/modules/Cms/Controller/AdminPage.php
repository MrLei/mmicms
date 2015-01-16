<?php

class Cms_Controller_AdminPage extends MmiCms_Controller_Admin {

	public function indexAction() {
		$this->view->grid = new Cms_Plugin_PageGrid();
	}
	
	public function editAction() {
		$form = new Cms_Form_Admin_Page($this->id);
		if ($form->isSaved()) {
			$this->_helper->messenger('Strona zapisana poprawnie', true);
			$this->_helper->redirector('index', 'adminPage', 'cms', array(), true);
		}
	}
	
	public function deleteAction() {
		if (null !== ($record = Cms_Model_Page_Dao::findPk($this->id)) && $record->delete()) {
			$this->_helper->messenger('Strona usunięta poprawnie');
		}
		$this->_helper->redirector('index', 'adminPage', 'cms', array(), true);
	}
	
}