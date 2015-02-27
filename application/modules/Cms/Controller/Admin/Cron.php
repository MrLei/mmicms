<?php

namespace Cms\Controller\Admin;

class Cron extends \MmiCms\Controller\Admin {

	public function indexAction() {
		$grid = new \Cms\Plugin\CronGrid();
		$this->view->grid = $grid;
	}

	public function editAction() {
		$form = new Cron\Form\Cron($this->id);
		if ($form->isSaved()) {
			$this->_helper->messenger('Zadanie zapisane poprawnie', true);
			return $this->_helper->redirector('index', 'admin', 'cron', array(), true);
		}
	}

	public function deleteAction() {
		if ($this->id) {
			$record = \Cms\Model\Cron\Query::factory()->findPk($this->id);
		}
		if ($record && $record->delete()) {
			$this->_helper->messenger('Zadanie CRON poprawnie usunięte', true);
		}
		return $this->_helper->redirector('index', 'admin', 'cron', array(), true);
	}

}
