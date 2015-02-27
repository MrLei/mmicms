<?php

namespace Cms\Controller\Admin;

class Page extends \MmiCms\Controller\Admin {

	public function indexAction() {
		$this->view->grid = new \Cms\Plugin\PageGrid();
	}

	public function editAction() {
		$form = new \Cms\Form\Admin\Page($this->id);
		if ($form->isSaved()) {
			$this->_helper->redirector('compose', 'admin-page', 'cms', array('id' => $form->getRecord()->id), true);
		}
	}

	public function composeAction() {
		if (!$this->id || null === ($page = \Cms\Model\Page\Query::factory()
			->where('id')->equals($this->id)
			->findFirst())) {
			$this->_helper->redirector('index', 'admin-page', 'cms', array(), true);
		}
		/* @var $page \Cms\Model\Page\Record */

		//lista aktywnych widgetow
		$this->view->widgets = \Cms\Model\Page\Widget\Dao::activeQuery()->find();

		//skrypty js
		$this->view->headScript()->prependFile($this->view->baseUrl . '/library/js/jquery/jquery.js');
		$this->view->headScript()->appendFile($this->view->baseUrl . '/library/js/jquery/ui.js');
		$this->view->headScript()->appendFile($this->view->baseUrl . '/default/cms/js/page.js');

		//css'y
		$this->view->headLink()->appendStyleSheet($this->view->baseUrl . '/default/cms/css/page.css');
		$this->view->headLink()->appendStyleSheet($this->view->baseUrl . '/default/cms/css/fonts/fontawesome/css/font-awesome.css');
		$this->view->headStyle()->appendStyleFile('default/cms/css/page.css');

		$withWidgets = preg_replace('/(\{widget\(([a-zA-Z1-9\'\,\s\(\=\>]+\))\)\})/', '<div class="composer-widget" data-widget="$2">$2</div>$1', $page->text);

		//ustawianie contentu
		$this->view->setPlaceholder('content', $this->view->render(APPLICATION_PATH . '/skins/default/cms/scripts/admin/page/toolkit.tpl') .
			'<div class="cms-page-composer">' . $this->view->renderDirectly($withWidgets) . '</div>');

		//render layoutu
		return $this->view->renderLayout($this->view->skin, 'cms', 'page');
	}

	public function updateAction() {
		$post = $this->getRequest()->getPost();
		if (!isset($post['id']) || !isset($post['data'])) {
			return json_encode(array('success' => 0));
		}
		$page = \Cms\Model\Page\Query::factory()
			->where('id')->equals($post['id'])
			->findFirst();
		if ($page === null) {
			return json_encode(array('success' => 0));
		}
		$page->text = htmlspecialchars_decode($post['data']);
		$page->save();
		return json_encode(array('success' => 1));
	}

	public function loadAction() {
		$this->getResponse()->setDebug(false);
		$post = $this->getRequest()->getPost();
		if (!isset($post['id'])) {
			return json_encode(array('success' => 0));
		}
		$page = \Cms\Model\Page\Query::factory()
			->whereId()->equals($post['id'])
			->findFirst();
		if ($page === null) {
			return json_encode(array('sucess' => 0));
		}
		//parsowanie widgetow do postaci zjadalnej przez composer
		$parsed = preg_replace('/\{widget\(([a-zA-Z1-9\'\,\s\(\=\>]+\))\)\}/', '<div class="widget" data-widget="$1">Widget</div>', $page->text);
		return $parsed;
	}

	public function deleteAction() {
		if (null !== ($record = \Cms\Model\Page\Dao::findPk($this->id)) && $record->delete()) {
			$this->_helper->messenger('Strona usunięta poprawnie');
		}
		$this->_helper->redirector('index', 'admin-page', 'cms', array(), true);
	}

}
