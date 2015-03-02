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
			$this->_helper->messenger('Zadanie zapisane poprawnie', true);
			return $this->_helper->redirector('index', 'admin-cron', 'cms', array(), true);
		}
	}

	public function deleteAction() {
		$record = \Cms\Model\Cron\Query::factory()->findPk($this->id);
		if ($record && $record->delete()) {
			$this->_helper->messenger('Zadanie CRON poprawnie usunięte', true);
		}
		return $this->_helper->redirector('index', 'admin-cron', 'cms', array(), true);
	}

}
