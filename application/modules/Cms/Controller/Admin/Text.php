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
		$text = \Cms\Model\Text\Query::factory()->findPk($this->id);
		if ($text && $text->delete()) {
			$this->_helper->messenger('Poprawnie skasowano tekst', true);
		}
		$this->_helper->redirector('index', 'admin-text', 'cms', array(), true);
	}

}
