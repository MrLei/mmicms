<?php

class Cms_Controller_AdminText extends MmiCms_Controller_Admin {

	public function indexAction() {
		$this->view->grid = new Cms_Plugin_TextGrid();
	}

	public function editAction() {
		$form = new Cms_Form_Admin_Text($this->_getParam('id'));
		if ($form->isSaved()) {
			$this->_helper->messenger('Poprawnie zapisano tekst', true);
			$this->_helper->redirector('index', 'adminText', 'cms', array(), true);
		}
	}

	public function deleteAction() {
		$text = new Cms_Model_Text_Record($this->_getParam('id'));
		if ($text->delete()) {
			$this->_helper->messenger('Poprawnie skasowano tekst', true);
		}
		$this->_helper->redirector('index', 'adminText', 'cms', array(), true);
	}

}
