<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Cms\Controller\Admin;

class Route extends \MmiCms\Controller\Admin {

	public function indexAction() {
		$this->view->grid = new \Cms\Plugin\RouteGrid();
	}

	public function editAction() {
		$form = new \Cms\Form\Admin\Route(new \Cms\Model\Route\Record($this->id));
		if ($form->isSaved()) {
			$this->getMessenger()->addMessage('Poprawnie zapisano trasę', true);
			$this->getResponse()->redirect('cms', 'admin-route', 'index');
		}
	}

	public function deleteAction() {
		$text = \Cms\Model\Route\Query::factory()->findPk($this->id);
		if ($text && $text->delete()) {
			$this->getMessenger()->addMessage('Poprawnie skasowano trasę');
		}
		$this->getResponse()->redirect('cms', 'admin-route', 'index');
	}

}
