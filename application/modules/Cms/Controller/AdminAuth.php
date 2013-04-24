<?php

class Cms_Controller_AdminAuth extends MmiCms_Controller_Admin {

	public function indexAction() {
		$this->view->grid = new Cms_Plugin_AuthGrid();
	}

	public function editAction() {
		$form = new Cms_Form_Admin_Auth($this->_getParam('id'));
		if ($form->isSaved()) {
			$this->_helper->messenger('Poprawnie zapisano użytkownika', true);
			return $this->_helper->redirector('index');
		}
	}

	public function deleteAction() {
		if ($this->_getParam('id') > 0) {
			$auth = new Cms_Model_Auth_Record($this->_getParam('id'));
			$auth->delete();
		}
		$this->_helper->messenger('Poprawnie skasowano użytkownika', true);
		return $this->_helper->redirector('index');
	}

}
