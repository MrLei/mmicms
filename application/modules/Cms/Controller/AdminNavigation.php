<?php

class Cms_Controller_AdminNavigation extends MmiCms_Controller_Admin {

	public function indexAction() {
		$config = new Mmi_Navigation_Config();
		Cms_Model_Navigation_Dao::decorateConfiguration($config);
		$this->view->navigation = $config->findById($this->id, true);
	}

	public function editAction() {
		switch ($this->type) {
			case 'link':
				$form = new Cms_Form_Admin_Page_Link($this->id);
				break;
			case 'folder':
				$form = new Cms_Form_Admin_Page_Folder($this->id);
				break;
			case 'container':
				$form = new Cms_Form_Admin_Page_Container($this->id);
				break;
			case 'simple':
				$form = new Cms_Form_Admin_Page_Article($this->id);
				break;
			default:
				$form = new Cms_Form_Admin_Page_Cms($this->id);
				break;
		}
		if ($form->isSaved()) {
			return $this->_helper->redirector('index', 'adminNavigation', 'cms', array('id' => $form->getRecord()->parentId), true);
		}
		/* if ($this->id > 0) {
		  $record = Cms_Model_Navigation_Dao::findPk($this->id);
		  if ($this->remove && $record) {
		  $parentId = $record->parentId;
		  $record->delete();
		  return $this->_helper->redirector('index', 'adminNavigation', 'cms', array('id' => $parentId), true);
		  }
		  } */
		$this->view->pageForm = $form;
	}

	/**
	 * Usuwanie elementu
	 */
	public function deleteAction() {
		$record = Cms_Model_Navigation_Dao::findPk($this->id);
		if ($record !== null) {
			$record->delete();
		}
		return $this->_helper->redirector('index', 'adminNavigation', 'cms', array('id' => $record->parentId), true);
	}

	public function sortAction() {
		$this->getResponse()->setTypePlain();
		if (!$this->order) {
			return $this->view->getTranslate()->_('Przenoszenie nie powiodło się');
		}
		parse_str(str_replace(array('&amp;', '&#38;'), '&', $this->order), $order);
		if (!isset($order['navigation-item'])) {
			return $this->view->getTranslate()->_('Przenoszenie nie powiodło się');
		}
		Cms_Model_Navigation_Dao::sortBySerial($order['navigation-item']);
		return '';
	}

}
