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
		$this->view->news = News_Model_Dao::findActiveWithFile($paginator->getLimit(), $paginator->getOffset());
		$this->view->paginator = $paginator;
	}

	public function topAction() {
		$limit = $this->_getParam('limit') ? intval($this->_getParam('limit')) : 5;
		if ($this->_getParam('widget') == 1) {
			Mmi_View::getInstance()->setLayoutDisabled();
		}
		$this->view->news = News_Model_Dao::findActiveWithFile($paginator->getLimit(), $paginator->getOffset());
	}

	public function displayAction() {
		$this->view->entry = News_Model_Dao::findFirstActiveByUri($this->_getParam('uri'));
		if ($this->view->entry === null) {
			$this->_helper->redirector('index', 'index', 'news', array(), true);
		}
		$this->view->navigation()->modifyLastBreadcrumb($this->view->entry->title, $_SERVER['REQUEST_URI']);
	}

}
