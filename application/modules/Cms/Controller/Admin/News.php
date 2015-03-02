<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Cms\Controller\Admin;

class News extends \MmiCms\Controller\Admin {

	public function indexAction() {
		$this->view->grid = new \Cms\Plugin\NewsGrid();
	}

	public function editAction() {
		$form = new \Cms\Form\Admin\News(new \Cms\Model\News\Record($this->id));
		if ($form->isSaved()) {
			$this->_helper->messenger('News zapisany poprawnie', true);
			$this->_helper->redirector('index', 'admin-news', 'cms', array(), true);
		}
	}

	public function deleteAction() {
		$article = \Cms\Model\News\Query::factory()->findPk($this->id);
		if ($article && $article->delete()) {
			$this->_helper->messenger('News usunięty poprawnie', true);
		}
		$this->_helper->redirector('index', 'admin-news', 'cms', array(), true);
	}

}
