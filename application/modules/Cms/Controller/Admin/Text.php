<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Cms\Controller\Admin;

/**
 * Zarządzanie tekstami statycznymi
 */
class Text extends \Cms\Controller\AdminAbstract {

	/**
	 * Grid tekstów
	 */
	public function indexAction() {
		$this->view->grid = new \Cms\Plugin\TextGrid();
	}

	/**
	 * Akcja edycji tekstu
	 */
	public function editAction() {
		$form = new \Cms\Form\Admin\Text(new \Cms\Model\Text\Record($this->id));
		$this->view->textForm = $form;
		//brak wysłanych danych
		if (!$form->isMine()) {
			return;
		}
		//zapisany
		if ($form->isSaved()) {
			$this->getMessenger()->addMessage('Poprawnie zapisano tekst', true);
			$this->getResponse()->redirect('cms', 'admin-text');
		}
		$this->getMessenger()->addMessage('Błąd zapisu tekstu, tekst o tym kluczu już istnieje', false);
	}

	/**
	 * Klonowanie tekstu
	 */
	public function cloneAction() {
		$form = new \Cms\Form\Admin\Text\Copy(new \Cms\Model\Text\Record());
		$this->view->copyForm = $form;
		//brak wysłanych danych
		if (!$form->isMine()) {
			return;
		}
		//zapis
		if ($form->isSaved()) {
			$this->getMessenger()->addMessage('Poprawnie sklonowano teksty', true);
			$this->getResponse()->redirect('cms', 'admin-text');
		}
		$this->getMessenger()->addMessage('Błąd klonowania tekstów', false);
	}

	/**
	 * Usuwanie tekstu
	 */
	public function deleteAction() {
		$text = \Cms\Model\Text\Query::factory()->findPk($this->id);
		//jeśli znaleziono tekst i udało się usunąć
		if ($text && $text->delete()) {
			$this->getMessenger()->addMessage('Poprawnie skasowano tekst', true);
		}
		$this->getResponse()->redirect('cms', 'admin-text');
	}

}
