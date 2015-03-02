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
			$this->_helper->messenger('Tag zapisany poprawnie', true);
			return $this->_helper->redirector('index', 'admin-tag', 'cms', array(), true);
		}
	}

	public function deleteAction() {
		$tag = \Cms\Model\Tag\Query::factory()->findPk($this->id);
		if ($tag && $tag->delete()) {
			$this->_helper->messenger('Tag usunięty', true);
		}
		return $this->_helper->redirector('index', 'admin-tag', 'cms', array(), true);
	}

}
