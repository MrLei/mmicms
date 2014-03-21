<?php

class News_Controller_Admin extends MmiCms_Controller_Admin {

	public function indexAction() {
		$this->view->grid = new News_Plugin_Grid();
	}

	public function editAction() {
		$form = new News_Form_Admin_Edit($this->_getParam('id'));
		if ($form->isSaved()) {
			$this->_helper->messenger('News zapisany poprawnie', true);
			$this->_helper->redirector('index', 'admin', 'news', array(), true);
		}
	}

	public function deleteAction() {
		if ($this->_getParam('id')) {
			$article = new News_Model_Record($this->_getParam('id'));
			if ($article->delete()) {
				$this->_helper->messenger('News usunięty poprawnie', true);
			}
		}
		$this->_helper->redirector('index', 'admin', 'news', array(), true);
	}

}
