<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Cms\Controller\Admin;

class Article extends \MmiCms\Controller\Admin {

	public function indexAction() {
		$this->view->grid = new \Cms\Plugin\ArticleGrid();
	}

	public function editAction() {
		$form = new \Cms\Form\Admin\Article(new \Cms\Model\Article\Record($this->id));
		if ($form->isSaved()) {
			$this->getMessenger()->addMessage('Artykuł zapisany poprawnie', true);
			$this->getResponse()->redirect('cms', 'admin-article');
		}
	}

	public function deleteAction() {
		$record = \Cms\Model\Article\Query::factory()->findPk($this->id);
		if ($record && $record->delete()) {
			$this->getMessenger()->addMessage('Poprawnie usunięto artykuł', true);
		}
		$this->getResponse()->redirect('cms', 'admin-article');
	}

}
