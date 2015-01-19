<?php

class Cms_Controller_AdminPage extends MmiCms_Controller_Admin {

	public function indexAction() {
		$this->view->grid = new Cms_Plugin_PageGrid();
	}

	public function editAction() {
		$form = new Cms_Form_Admin_Page($this->id);
		if ($form->isSaved()) {
			$this->_helper->redirector('compose', 'adminPage', 'cms', array('id' => $this->id), true);
		}
	}

	public function composeAction() {
		if (!$this->id || null === ($page = Cms_Model_Page_Query::factory()
			->where('id')->equals($this->id)
			->findFirst())) {
			$this->_helper->redirector('index', 'adminPage', 'cms', array(), true);
		}
		/* @var $page Cms_Model_Page_Record */
		$this->view->headLink()->appendStyleSheet($this->view->baseUrl . '/default/cms/css/page.css');
		$this->view->headScript()->prependFile($this->view->baseUrl . '/library/js/jquery/jquery.js');
		$this->view->headScript()->appendFile($this->view->baseUrl . '/library/js/jquery/ui.js');
		$this->view->headScript()->appendFile($this->view->baseUrl . '/default/cms/js/page.js');
		$this->view->setPlaceholder('content', '<div id="cms-page-composer-toolkit"></div><div id="cms-page-composer">' . $this->view->renderDirectly($page->text) . '</div>');
		return $this->view->renderLayout($this->view->skin, 'cms', 'page');
	}

	public function deleteAction() {
		if (null !== ($record = Cms_Model_Page_Dao::findPk($this->id)) && $record->delete()) {
			$this->_helper->messenger('Strona usunięta poprawnie');
		}
		$this->_helper->redirector('index', 'adminPage', 'cms', array(), true);
	}

}
