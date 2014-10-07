<?php

class Cms_Controller_AdminComment extends MmiCms_Controller_Admin {

	public function indexAction() {
		$this->view->grid = new Cms_Plugin_CommentGrid();
	}

	public function deleteAction() {
		$comment = new Cms_Model_Comment_Record($this->id);
		if ($comment->delete()) {
			$this->_helper->messenger('Poprawnie usunięto artykuł', true);
		}
		$this->_helper->redirector('index', 'adminComment', 'cms', array(), true);
	}

}
