<?php

class Cms_Controller_Admin_Article extends MmiCms_Controller_Admin {

	public function indexAction() {
		$this->view->grid = new Cms_Plugin_ArticleGrid();
	}

	public function editAction() {
		$form = new Cms_Form_Admin_Article($this->id);
		if ($form->isSaved()) {
			$this->_helper->messenger('Artykuł zapisany poprawnie', true);
			$this->_helper->redirector('index', 'admin-article', 'cms', array(), true);
		}
	}

	public function deleteAction() {
		$record = new Cms_Model_Article_Record($this->id);
		if ($record->delete()) {
			$this->_helper->messenger('Poprawnie usunięto artykuł', true);
		}
		$this->_helper->redirector('index', 'admin-article', 'cms', array(), true);
	}

}
