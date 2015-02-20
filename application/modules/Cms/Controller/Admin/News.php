<?php


namespace Cms\Controller\Admin;

class News extends \MmiCms\Controller\Admin {

	public function indexAction() {
		$this->view->grid = new \Cms\Plugin\NewsGrid();
	}

	public function editAction() {
		$form = new \Cms\Form\Admin\News($this->id);
		if ($form->isSaved()) {
			$this->_helper->messenger('News zapisany poprawnie', true);
			$this->_helper->redirector('index', 'admin-news', 'cms', array(), true);
		}
	}

	public function deleteAction() {
		if ($this->id) {
			$article = new \Cms\Model\News\Record($this->id);
			if ($article->delete()) {
				$this->_helper->messenger('News usunięty poprawnie', true);
			}
		}
		$this->_helper->redirector('index', 'admin-news', 'cms', array(), true);
	}

}
