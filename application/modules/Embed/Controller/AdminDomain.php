<?php

class Embed_Controller_AdminDomain extends MmiCms_Controller_Admin {

	public function indexAction() {
		$this->view->grid = new Embed_Plugin_DomainGrid();
	}

	public function editAction() {
		$form = new Embed_Form_Admin_Domain($this->id);
		if ($form->isSaved()) {
			$this->_helper->messenger('Zaktualizowano ustawienia domeny', true);
			$this->_helper->redirector('index', 'adminDomain', 'embed', array(), true);
		}
	}

	public function deleteAction() {
		if ($this->id > 0) {
			$domain = new Embed_Model_Domain($this->id);
			$domain->delete();
		}
		$this->_helper->messenger('Usunięto domenę', true);
		$this->_helper->redirector('index', 'adminDomain', 'embed', array(), true);
	}

}
