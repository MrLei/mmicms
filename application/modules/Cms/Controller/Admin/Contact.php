<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Cms\Controller\Admin;

class Contact extends \MmiCms\Controller\Admin {

	public function indexAction() {
		$this->view->grid = new \Cms\Plugin\ContactGrid();
	}

	public function subjectAction() {
		$this->view->grid = new \Cms\Plugin\ContactOptionGrid();
	}

	public function editSubjectAction() {
		$form = new \Cms\Form\Admin\Contact\Option(new \Cms\Model\Contact\Option\Record($this->id));
		if ($form->isSaved()) {
			$this->_helper->messenger('Poprawnie zapisano temat kontaktu', true);
			$this->_helper->redirector('subject');
		}
	}

	public function deleteSubjectAction() {
		$option = \Cms\Model\Contact\Option\Query::factory()->findPk($this->id);
		if ($option && $option->delete()) {
			$this->_helper->messenger('Poprawnie usunięto temat', true);
		}
		$this->_helper->redirector('subject');
	}

	public function deleteAction() {
		$contact = \Cms\Model\Contact\Query::factory()->findPk($this->id);
		if ($contact && $contact->delete()) {
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
