<?php

class Embed_Controller_AdminDomain extends MmiCms_Controller_Admin {
	
	public function indexAction() {
		$this->view->grid = new Embed_Plugin_DomainGrid();
	}

	public function editAction() {
		$form = new Embed_Form_Admin_Domain($this->_getParam('id'));
		if ($form->isSaved()) {
			$this->_helper->messenger('Zaktualizowano ustawienia domeny', true);
			$this->_helper->redirector('index', 'adminDomain', 'embed', array(), true);
		}
	}
	
	public function deleteAction() {
		if ($this->_getParam('id') > 0) {
			$domain = new Embed_Model_Domain($this->_getParam('id'));
			$domain->delete();
		}
		$this->_helper->messenger('Usunięto domenę');
		$this->_helper->redirector('index', 'adminDomain', 'embed', array(), true);
	}
	
}
