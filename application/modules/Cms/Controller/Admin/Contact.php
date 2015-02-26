<?php

namespace Cms\Controller\Admin;

class Contact extends \MmiCms\Controller\Admin {

	public function indexAction() {
		$this->view->grid = new \Cms\Plugin\ContactGrid();
	}

	public function subjectAction() {
		$this->view->grid = new \Cms\Plugin\ContactOptionGrid();
	}

	public function editSubjectAction() {
		$form = new \Cms\Form\Admin\Contact\Option($this->id);
		if ($form->isSaved()) {
			$this->_helper->messenger('Poprawnie zapisano temat kontaktu', true);
			$this->_helper->redirector('subject');
		}
	}

	public function deleteSubjectAction() {
		$option = new \Cms\Model\Contact\Option\Record($this->id);
		if ($option->delete()) {
			$this->_helper->messenger('Poprawnie usunięto temat', true);
		}
		$this->_helper->redirector('subject');
	}

	public function deleteAction() {
		$contact = new \Cms\Model\Contact\Record($this->id);
		if ($contact->delete()) {
			$this->_helper->messenger('Poprawnie usunięto wiadomość', true);
		}
		$this->_helper->redirector('index');
	}

	public function editAction() {
		$form = new \Cms\Form\Admin\Contact($this->id);
		if ($form->isSaved()) {
			$this->_helper->messenger('Wysłano odpowiedź na wiadomość', true);
			$this->_helper->redirector('index');
		}
	}

}
