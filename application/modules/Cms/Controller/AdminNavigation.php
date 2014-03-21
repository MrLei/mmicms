<?php

class Cms_Controller_AdminNavigation extends MmiCms_Controller_Admin {

	public function indexAction() {
		Cms_Model_Navigation_Dao::resetNested();
		$this->view->navigation = Cms_Model_Navigation_Dao::seek($this->_getParam('id'));
	}

	public function editAction() {
		switch ($this->_getParam('type')) {
			case 'link':
				$form = new Cms_Form_Admin_Page_Link($this->_getParam('id'));
				break;
			case 'folder':
				$form = new Cms_Form_Admin_Page_Folder($this->_getParam('id'));
				break;
			case 'container':
				$form = new Cms_Form_Admin_Page_Container($this->_getParam('id'));
				break;
			case 'simple':
				$form = new Cms_Form_Admin_Page_Article($this->_getParam('id'));
				break;
			default:
				$form = new Cms_Form_Admin_Page_Cms($this->_getParam('id'));
				break;
		}
		if ($form->isSaved()) {
			return $this->_helper->redirector('index', 'adminNavigation', 'cms', array('id' => $form->getRecord()->parent_id), true);
		}
		if ($this->_getParam('id') > 0) {
			$model = new Cms_Model_Navigation_Record($this->_getParam('id'));
			if ($this->_getParam('remove')) {
				$parentId = $model->parent_id;
				$model->delete();
				return $this->_helper->redirector('index', 'adminNavigation', 'cms', array('id' => $parentId), true);
			}
		}
		$this->view->pageForm = $form;
	}

	/**
	 * Usuwanie elementu
	 */
	public function deleteAction() {
		$record = new Cms_Model_Navigation_Record($this->_getParam('id'));
		$record->delete();
		return $this->_helper->redirector('index', 'adminNavigation', 'cms', array('id' => $record->parent_id), true);
	}

	public function sortAction() {
		if (!$this->_getParam('order')) {
			die($this->view->getTranslate()->_('Przenoszenie nie powiodło się'));
		}
		parse_str(str_replace(array('&amp;', '&#38;'), '&', $this->_getParam('order')), $order);
		if (!isset($order['navigation-item'])) {
			die($this->view->getTranslate()->_('Przenoszenie nie powiodło się'));
		}
		Cms_Model_Navigation_Dao::sortBySerial($order['navigation-item']);
		die();
	}
}
