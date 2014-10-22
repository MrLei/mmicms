<?php

class Cms_Controller_AdminTag extends MmiCms_Controller_Admin {

	public function indexAction() {
		$this->view->grid = new Cms_Plugin_TagGrid();
	}

	public function editAction() {
		$form = new Cms_Form_Admin_Tag($this->id);
		if ($form->isSaved()) {
			$this->_helper->messenger('Tag zapisany poprawnie', true);
			return $this->_helper->redirector('index', 'adminTag', 'cms', array(), true);
		}
	}

	public function deleteAction() {
		$tag = new Cms_Model_Tag_Record($this->id);
		if ($tag->delete()) {
			$this->_helper->messenger('Tag usunięty', true);
		}
		return $this->_helper->redirector('index', 'adminTag', 'cms', array(), true);
	}

}