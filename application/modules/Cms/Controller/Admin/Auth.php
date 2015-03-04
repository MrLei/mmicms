<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Cms\Controller\Admin;

class Auth extends \MmiCms\Controller\Admin {

	public function indexAction() {
		$this->view->grid = new \Cms\Plugin\AuthGrid();
	}

	public function editAction() {
		$form = new \Cms\Form\Admin\Auth(new \Cms\Model\Auth\Record($this->id));
		if ($form->isSaved()) {
			$this->getMessenger()->addMessage('Poprawnie zapisano użytkownika', true);
			$this->getResponse()->redirect('cms', 'admin-auth');
		}
		$this->view->authForm = $form;
	}

	public function deleteAction() {
		$auth = \Cms\Model\Auth\Query::factory()->findFirst($this->id);
		if ($auth && $auth->delete()) {
			$this->getMessenger()->addMessage('Poprawnie skasowano użytkownika', true);
		}
		$this->getResponse()->redirect('cms', 'admin-auth');
	}

}
