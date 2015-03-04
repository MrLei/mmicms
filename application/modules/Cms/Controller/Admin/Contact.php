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
			$this->getMessenger()->addMessage('Poprawnie zapisano temat kontaktu', true);
			$this->getResponse()->redirect('cms', 'admin-contact', 'subject');
		}
		$this->view->optionForm = $form;
	}

	public function deleteSubjectAction() {
		$option = \Cms\Model\Contact\Option\Query::factory()->findPk($this->id);
		if ($option && $option->delete()) {
			$this->getMessenger()->addMessage('Poprawnie usunięto temat', true);
		}
		$this->getResponse()->redirect('cms', 'admin-contact', 'subject');
	}

	public function deleteAction() {
		$contact = \Cms\Model\Contact\Query::factory()->findPk($this->id);
		if ($contact && $contact->delete()) {
			$this->getMessenger()->addMessage('Poprawnie usunięto wiadomość', true);
		}
		$this->getResponse()->redirect('cms', 'admin-contact');
	}

	public function editAction() {
		$form = new \Cms\Form\Admin\Contact($this->id);
		if ($form->isSaved()) {
			$this->getMessenger()->addMessage('Wysłano odpowiedź na wiadomość', true);
			$this->getResponse()->redirect('cms', 'admin-contact');
		}
		$this->view->contactForm = $form;
	}

}
