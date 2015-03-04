<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Cms\Controller\Admin;

class Tag extends \MmiCms\Controller\Admin {

	public function indexAction() {
		$this->view->grid = new \Cms\Plugin\TagGrid();
	}

	public function editAction() {
		$form = new \Cms\Form\Admin\Tag(new \Cms\Model\Tag\Record($this->id));
		if ($form->isSaved()) {
			$this->getMessenger()->addMessage('Tag zapisany poprawnie', true);
			$this->getResponse()->redirect('cms', 'admin-tag', 'index');
		}
		$this->view->tagForm = $form;
	}

	public function deleteAction() {
		$tag = \Cms\Model\Tag\Query::factory()->findPk($this->id);
		if ($tag && $tag->delete()) {
			$this->getMessenger()->addMessage('Tag usunięty', true);
		}
		$this->getResponse()->redirect('cms', 'admin-tag', 'index');
	}

}
