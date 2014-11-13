<?php
class Cron_Controller_Admin extends MmiCms_Controller_Admin {

	public function indexAction() {
		$grid = new Cron_Plugin_Grid();
		$this->view->grid = $grid;
	}

	public function editAction() {
		$form = new Cron_Form_Cron($this->id);
		if ($form->isSaved ()) {
			$this->_helper->messenger('Zadanie zapisane poprawnie', true);
			return $this->_helper->redirector('index', 'admin', 'cron', array(), true);
		}
	}

	public function deleteAction() {
		if ($this->id) {
			$record = Cron_Model_Dao::findPk($this->id);
		}
		if ($record && $record->delete()) {
			$this->_helper->messenger('Zadanie CRON poprawnie usunięte', true);
		}
		return $this->_helper->redirector('index', 'admin', 'cron', array(), true);
	}

}