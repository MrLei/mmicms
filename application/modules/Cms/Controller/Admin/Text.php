<?php

namespace Cms\Controller\Admin;

class Text extends \MmiCms\Controller\Admin {

	public function indexAction() {
		$this->view->grid = new \Cms\Plugin\TextGrid();
	}

	public function editAction() {
		$form = new \Cms\Form\Admin\Text($this->id);
		if (!$form->isMine()) {
			return;
		}
		if ($form->isSaved()) {
			$this->_helper->messenger('Poprawnie zapisano tekst', true);
			$this->_helper->redirector('index', 'admin-text', 'cms', array(), true);
		}
		$this->_helper->messenger('Błąd zapisu tekstu, tekst o tym kluczu już istnieje', false);
	}

	public function cloneAction() {
		$form = new \Cms\Form\Admin\Text\Copy();
		if (!$form->isMine()) {
			return;
		}
		if ($form->isSaved()) {
			$this->_helper->messenger('Poprawnie sklonowano teksty', true);
			$this->_helper->redirector('index', 'admin-text', 'cms', array(), true);
		}
		$this->_helper->messenger('Błąd klonowania tekstów', false);
	}

	public function deleteAction() {
		$text = new \Cms\Model\Text\Record($this->id);
		if ($text->delete()) {
			$this->_helper->messenger('Poprawnie skasowano tekst', true);
		}
		$this->_helper->redirector('index', 'admin-text', 'cms', array(), true);
	}

}
