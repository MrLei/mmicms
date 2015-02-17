<?php

class Mail_Controller_Admin_Server extends MmiCms_Controller_Admin {

	public function indexAction() {
		$grid = new Mail_Plugin_ServerGrid();
		$this->view->grid = $grid;
	}

	public function editAction() {
		$form = new Mail_Form_Admin_Server($this->id);
		if ($form->isSaved()) {
			$this->_helper->messenger('Zapisano ustawienia serwera', true);
			$this->_helper->redirector('index', 'adminServer', 'mail', array(), true);
		}
	}

	public function deleteAction() {
		$server = new Mail_Model_Server_Record($this->id);
		try {
			if ($server && $server->delete()) {
				$this->_helper->messenger('Usunięto serwer');
			}
		} catch (Exception $e) {
			if (stripos($e->getMessage(), 'DB exception') !== false) {
				$this->_helper->messenger('Nie można usunąć serwera, istnieją powiązane szablony', false);
			} else {
				throw $e;
			}
		}
		$this->_helper->redirector('index', 'adminServer', 'mail', array(), true);
	}

}
