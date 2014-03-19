<?php

class Cms_Controller_AdminFile extends MmiCms_Controller_Admin {

	public function indexAction() {
		$this->view->grid = new Cms_Plugin_FileGrid();
	}

	public function stickAction() {
		if (!$this->_getParam('id')) {
			die();
		}
		$file = new Cms_Model_File_Record($this->_getParam('id'));
		if ($this->_getParam('hash') != substr($file->name, 0, 10)) {
			die($this->view->getTranslate()->_('Przypinanie nie powiodło się'));
		}
		$file->setSticky();
		die();
	}

	public function editAction() {
		if (!($this->_getParam('id') > 0)) {
			die($this->view->getTranslate()->_('Edycja nie powiodła się, brak pliku'));
		}
		$file = new Cms_Model_File_Record($this->_getParam('id'));
		if (!empty($_POST)) {
			if ($this->_getParam('hash') != $file->getHashName()) {
				die($this->view->getTranslate()->_('Edycja nie powiodła się'));
			}
			$file->setFromArray($_POST);
			$file->save();
			die();
		}
		if ($this->_getParam('hash') != $file->getHashName()) {
				die(json_encode(array('error' => 'Brak pliku')));
		}
		die($file->toJson());
	}

	public function removeAction() {
		if (!($this->_getParam('id') > 0)) {
			$this->_helper->redirector('index');
		}
		$file = new Cms_Model_File_Record($this->_getParam('id'));
		$file->delete();
		$this->_helper->messenger('Poprawnie usunięto plik', true);
		$this->_helper->redirector('index');
	}

	public function deleteAction() {
		if (!($this->_getParam('id') > 0)) {
			die($this->view->getTranslate()->_('Usuwanie nie powiodło się, brak pliku'));
		}
		$file = new Cms_Model_File_Record($this->_getParam('id'));
		if ($this->_getParam('hash') != $file->getHashName()) {
			die($this->view->getTranslate()->_('Usuwanie nie powiodło się'));
		}
		$file->delete();
		die();
	}

	public function sortAction() {
		if (!$this->_getParam('order')) {
			die($this->view->getTranslate()->_('Przenoszenie nie powiodło się'));
		}
		parse_str(str_replace('&amp;', '&', $this->_getParam('order')), $order);
		if (!isset($order['item-file'])) {
			die($this->view->getTranslate()->_('Przenoszenie nie powiodło się'));
		}
		Cms_Model_File_Dao::sortBySerial($order['item-file']);
		die();
	}

}