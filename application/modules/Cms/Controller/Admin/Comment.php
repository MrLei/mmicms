<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Cms\Controller\Admin;

class Comment extends \Cms\Controller\AdminAbstract {

	public function indexAction() {
		$this->view->grid = new \Cms\Plugin\CommentGrid();
	}

	public function deleteAction() {
		$comment = \Cms\Model\Comment\Query::factory()->findPk($this->id);
		if ($comment && $comment->delete()) {
			$this->getMessenger()->addMessage('Poprawnie usunięto artykuł', true);
		}
		$this->getResponse()->redirect('cms', 'admin-comment');
	}

}
