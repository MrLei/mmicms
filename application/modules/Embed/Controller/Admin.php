<?php

class Embed_Controller_Admin extends MmiCms_Controller_Admin {

	public function indexAction() {
		$this->view->grid = new Embed_Plugin_Grid();
	}

	public function editAction() {
		$form = new Embed_Form_Admin_Embed($this->id);
		if ($form->isSaved()) {
			$this->_helper->messenger('Zaktualizowano konfigurację widgeta', true);
			$this->_helper->redirector('index', 'admin', 'embed', array(), true);
		}
	}

	public function deleteAction() {
		if ($this->id > 0) {
			$embed = new Embed_Model_Admin_Embed($this->id);
			$embed->delete();
		}
		$this->_helper->messenger('Usunięto konfigurację widgeta', true);
		$this->_helper->redirector('index', 'admin', 'embed', array(), true);
	}

}