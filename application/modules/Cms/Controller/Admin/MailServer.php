<?php

class Cms_Controller_Admin_MailServer extends MmiCms_Controller_Admin {

	public function indexAction() {
		$grid = new Cms_Plugin_MailServerGrid();
		$this->view->grid = $grid;
	}

	public function editAction() {
		$form = new Cms_Form_Admin_Mail_Server($this->id);
		if ($form->isSaved()) {
			$this->_helper->messenger('Zapisano ustawienia serwera', true);
			$this->_helper->redirector('index', 'admin-mailServer', 'cms', array(), true);
		}
	}

	public function deleteAction() {
		$server = new Cms_Model_Mail_Server_Record($this->id);
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
		$this->_helper->redirector('index', 'admin-mailServer', 'cms', array(), true);
	}

}
