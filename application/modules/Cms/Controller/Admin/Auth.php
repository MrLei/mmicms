<?php


namespace Cms\Controller\Admin;

class Auth extends \MmiCms\Controller\Admin {

	public function indexAction() {
		$this->view->grid = new \Cms\Plugin\AuthGrid();
	}

	public function editAction() {
		$form = new \Cms\Form\Admin\Auth($this->id);
		if ($form->isSaved()) {
			$this->_helper->messenger('Poprawnie zapisano użytkownika', true);
			return $this->_helper->redirector('index');
		}
	}

	public function deleteAction() {
		if ($this->id > 0) {
			$auth = new \Cms\Model\Auth\Record($this->id);
			$auth->delete();
		}
		$this->_helper->messenger('Poprawnie skasowano użytkownika', true);
		return $this->_helper->redirector('index');
	}

}
