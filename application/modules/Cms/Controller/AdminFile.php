<?php

class Cms_Controller_AdminFile extends MmiCms_Controller_Admin {

	public function indexAction() {
		$this->view->grid = new Cms_Plugin_FileGrid();
	}

	public function stickAction() {
		if (!$this->_getParam('id')) {
			return '';
		}
		$file = new Cms_Model_File_Record($this->_getParam('id'));
		if ($this->_getParam('hash') != $file->name) {
			return $this->view->getTranslate()->_('Przypinanie nie powiodło się');
		}
		$file->setSticky();
		return '';
	}

	public function editAction() {
		if (!($this->_getParam('id') > 0)) {
			return $this->view->getTranslate()->_('Edycja nie powiodła się, brak pliku');
		}
		$file = new Cms_Model_File_Record($this->_getParam('id'));
		if (!empty($_POST)) {
			if ($this->_getParam('hash') != $file->getHashName()) {
				return $this->view->getTranslate()->_('Edycja nie powiodła się');
			}
			$file->setFromArray($_POST);
			$file->save();
			return '';
		}
		if ($this->_getParam('hash') != $file->getHashName()) {
				return json_encode(array('error' => 'Brak pliku'));
		}
		return $file->toJson();
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
			return $this->view->getTranslate()->_('Usuwanie nie powiodło się, brak pliku');
		}
		$file = new Cms_Model_File_Record($this->_getParam('id'));
		if ($this->_getParam('hash') != $file->getHashName()) {
			return $this->view->getTranslate()->_('Usuwanie nie powiodło się');
		}
		$file->delete();
		return '';
	}

	public function sortAction() {
		if (!$this->_getParam('order')) {
			return $this->view->getTranslate()->_('Przenoszenie nie powiodło się');
		}
		parse_str(str_replace(array('&amp;', '&#38;'), '&', $this->_getParam('order')), $order);
		if (!isset($order['item-file'])) {
			return $this->view->getTranslate()->_('Przenoszenie nie powiodło się');
		}
		Cms_Model_File_Dao::sortBySerial($order['item-file']);
		return '';
	}

}