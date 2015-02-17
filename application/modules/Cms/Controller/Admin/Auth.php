<?php

class Cms_Controller_Admin_Auth extends MmiCms_Controller_Admin {

	public function indexAction() {
		$this->view->grid = new Cms_Plugin_AuthGrid();
	}

	public function editAction() {
		$form = new Cms_Form_Admin_Auth($this->id);
		if ($form->isSaved()) {
			$this->_helper->messenger('Poprawnie zapisano użytkownika', true);
			return $this->_helper->redirector('index');
		}
	}

	public function deleteAction() {
		if ($this->id > 0) {
			$auth = new Cms_Model_Auth_Record($this->id);
			$auth->delete();
		}
		$this->_helper->messenger('Poprawnie skasowano użytkownika', true);
		return $this->_helper->redirector('index');
	}

}
