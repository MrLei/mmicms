<?php

namespace Cms\Controller\Admin;

class Comment extends \MmiCms\Controller\Admin {

	public function indexAction() {
		$this->view->grid = new \Cms\Plugin\CommentGrid();
	}

	public function deleteAction() {
		$comment = new \Cms\Model\Comment\Record($this->id);
		if ($comment->delete()) {
			$this->_helper->messenger('Poprawnie usunięto artykuł', true);
		}
		$this->_helper->redirector('index', 'admin-comment', 'cms', array(), true);
	}

}
