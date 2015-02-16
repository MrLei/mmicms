<?php

class Cms_Controller_AdminContact extends MmiCms_Controller_Admin {

	public function indexAction() {
		$this->view->grid = new Cms_Plugin_ContactGrid();
	}

	public function subjectAction() {
		$this->view->grid = new Cms_Plugin_ContactOptionGrid();
	}

	public function editSubjectAction() {
		$form = new Cms_Form_Admin_Contact_Option($this->id);
		if ($form->isSaved()) {
			$this->_helper->messenger('Poprawnie zapisano temat kontaktu', true);
			$this->_helper->redirector('subject');
		}
	}

	public function deleteSubjectAction() {
		$option = new Cms_Model_Contact_Option_Record($this->id);
		if ($option->delete()) {
			$this->_helper->messenger('Poprawnie usunięto temat', true);
		}
		$this->_helper->redirector('subject');
	}

	public function deleteAction() {
		$contact = new Cms_Model_Contact_Record($this->id);
		if ($contact->delete()) {
			$this->_helper->messenger('Poprawnie usunięto wiadomość', true);
		}
		$this->_helper->redirector('index');
	}

	public function editAction() {
		$form = new Cms_Form_Admin_Contact($this->id);
		if ($form->isSaved()) {
			$this->_helper->messenger('Wysłano odpowiedź na wiadomość', true);
			$this->_helper->redirector('index');
		}
	}

}
