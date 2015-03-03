<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Cms\Controller\Admin;

class Text extends \MmiCms\Controller\Admin {

	public function indexAction() {
		$this->view->grid = new \Cms\Plugin\TextGrid();
	}

	public function editAction() {
		$form = new \Cms\Form\Admin\Text(new \Cms\Model\Text\Record($this->id));
		if (!$form->isMine()) {
			return;
		}
		if ($form->isSaved()) {
			$this->getMessenger()->addMessage('Poprawnie zapisano tekst', true);
			$this->getResponse()->redirect('cms', 'admin-text', 'index');
		}
		$this->getMessenger()->addMessage('Błąd zapisu tekstu, tekst o tym kluczu już istnieje', false);
	}

	public function cloneAction() {
		$form = new \Cms\Form\Admin\Text\Copy();
		if (!$form->isMine()) {
			return;
		}
		if ($form->isSaved()) {
			$this->getMessenger()->addMessage('Poprawnie sklonowano teksty', true);
			$this->getResponse()->redirect('cms', 'admin-text', 'index');
		}
		$this->getMessenger()->addMessage('Błąd klonowania tekstów', false);
	}

	public function deleteAction() {
		$text = \Cms\Model\Text\Query::factory()->findPk($this->id);
		if ($text && $text->delete()) {
			$this->getMessenger()->addMessage('Poprawnie skasowano tekst', true);
		}
		$this->getResponse()->redirect('cms', 'admin-text', 'index');
	}

}
