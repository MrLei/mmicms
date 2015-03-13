<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Cms\Controller\Admin;

class MailServer extends \Cms\Controller\AdminAbstract {

	public function indexAction() {
		$grid = new \Cms\Plugin\MailServerGrid();
		$this->view->grid = $grid;
	}

	public function editAction() {
		$form = new \Cms\Form\Admin\Mail\Server(new \Cms\Model\Mail\Server\Record($this->id));
		if ($form->isSaved()) {
			$this->getMessenger()->addMessage('Zapisano ustawienia serwera', true);
			$this->getResponse()->redirect('cms', 'admin-mailServer');
		}
		$this->view->serverForm = $form;
	}

	public function deleteAction() {
		$server = \Cms\Model\Mail\Server\Query::factory()->findPk($this->id);
		try {
			if ($server && $server->delete()) {
				$this->getMessenger()->addMessage('Usunięto serwer');
			}
		} catch (\Mmi\Db\Exception $e) {
			$this->getMessenger()->addMessage('Nie można usunąć serwera, istnieją powiązane szablony', false);
		}
		$this->getResponse()->redirect('cms', 'admin-mailServer');
	}

}
