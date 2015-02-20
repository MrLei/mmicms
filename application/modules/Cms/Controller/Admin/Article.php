<?php


namespace Cms\Controller\Admin;

class Article extends \MmiCms\Controller\Admin {

	public function indexAction() {
		$this->view->grid = new \Cms\Plugin\ArticleGrid();
	}

	public function editAction() {
		$form = new \Cms\Form\Admin\Article($this->id);
		if ($form->isSaved()) {
			$this->_helper->messenger('Artykuł zapisany poprawnie', true);
			$this->_helper->redirector('index', 'admin-article', 'cms', array(), true);
		}
	}

	public function deleteAction() {
		$record = new \Cms\Model\Article\Record($this->id);
		if ($record->delete()) {
			$this->_helper->messenger('Poprawnie usunięto artykuł', true);
		}
		$this->_helper->redirector('index', 'admin-article', 'cms', array(), true);
	}

}
