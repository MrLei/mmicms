<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Cms\Controller\Admin;

class Cron extends \MmiCms\Controller\Admin {

	public function indexAction() {
		$grid = new \Cms\Plugin\CronGrid();
		$this->view->grid = $grid;
	}

	public function editAction() {
		$form = new \Cms\Form\Admin\Cron(new \Cms\Model\Cron\Record($this->id));
		if ($form->isSaved()) {
			$this->getMessenger()->addMessage('Zadanie zapisane poprawnie', true);
			$this->getResponse()->redirect('cms', 'admin-cron');
		}
		$this->view->cronForm = $form;
	}

	public function deleteAction() {
		$record = \Cms\Model\Cron\Query::factory()->findPk($this->id);
		if ($record && $record->delete()) {
			$this->getMessenger()->addMessage('Zadanie CRON poprawnie usunięte', true);
		}
		$this->getResponse()->redirect('cms', 'admin-cron');
	}

}
