<?php


namespace Cms\Controller\Admin;

class Tag extends \MmiCms\Controller\Admin {

	public function indexAction() {
		$this->view->grid = new \Cms\Plugin\TagGrid();
	}

	public function editAction() {
		$form = new \Cms\Form\Admin\Tag($this->id);
		if ($form->isSaved()) {
			$this->_helper->messenger('Tag zapisany poprawnie', true);
			return $this->_helper->redirector('index', 'admin-tag', 'cms', array(), true);
		}
	}

	public function deleteAction() {
		$tag = new \Cms\Model\Tag\Record($this->id);
		if ($tag->delete()) {
			$this->_helper->messenger('Tag usunięty', true);
		}
		return $this->_helper->redirector('index', 'admin-tag', 'cms', array(), true);
	}

}
