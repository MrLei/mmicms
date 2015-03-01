<?php

namespace Cms\Controller\Admin;

class Route extends \MmiCms\Controller\Admin {

	public function indexAction() {
		$this->view->grid = new \Cms\Plugin\RouteGrid();
	}

	public function editAction() {
		$form = new \Cms\Form\Admin\Route(new \Cms\Model\Route\Record($this->id));
		if ($form->isSaved()) {
			$this->_helper->messenger('Poprawnie zapisano trasę', true);
			$this->_helper->redirector('index', 'admin-route', 'cms', array(), true);
		}
	}

	public function deleteAction() {
		$text = \Cms\Model\Route\Query::factory()->findPk($this->id);
		if ($text && $text->delete()) {
			$this->_helper->messenger('Poprawnie skasowano trasę');
		}
		$this->_helper->redirector('index', 'admin-route', 'cms', array(), true);
	}

}
