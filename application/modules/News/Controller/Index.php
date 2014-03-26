<?php

class News_Controller_Index extends Mmi_Controller_Action {

	public function indexAction() {
		//przekierowanie z posta z ilością podstron
		if ($this->getRequest()->getPost()) {
			$this->_helper->redirector('index', 'index', 'news', array('pages' => intval($_POST['pages'])), true);
		}
		$paginator = new Mmi_Paginator();
		$pages = 10;
		//ustawianie ilości stron na liście
		if ($this->_getParam('pages')) {
			if ($this->_getParam('pages') % 10 != 0) {
				$this->_helper->redirector('index', 'index', 'news', array(), true);
			}
			$pages = (int)$this->_getParam('pages');
		}
		$paginator->setRowsPerPage($pages);
		$paginator->setRowsCount(News_Model_Dao::countActive());
		$this->view->news = News_Model_Dao::findActive($paginator->getLimit(), $paginator->getOffset());
		$this->view->paginator = $paginator;
	}

	public function topAction() {
		$limit = $this->_getParam('limit') ? intval($this->_getParam('limit')) : 5;
		$this->view->news = News_Model_Dao::findActive($limit);
	}

	public function displayAction() {
		$this->view->item = News_Model_Dao::findFirstActiveByUri($this->_getParam('uri'));
		if ($this->view->item === null) {
			$this->_helper->redirector('index', 'index', 'news', array(), true);
		}
		$this->view->navigation()->modifyLastBreadcrumb($this->view->item->title, $this->view->url());
	}

}
