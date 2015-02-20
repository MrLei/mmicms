<?php


namespace Cms\Controller\Admin;

class Navigation extends \MmiCms\Controller\Admin {

	public function indexAction() {
		$config = new \Mmi\Navigation\Config();
		\Cms\Model\Navigation\Dao::decorateConfiguration($config);
		$this->view->navigation = $config->findById($this->id, true);
	}

	public function editAction() {
		switch ($this->type) {
			case 'link':
				$form = new \Cms\Form\Admin\Page\Link($this->id);
				break;
			case 'folder':
				$form = new \Cms\Form\Admin\Page\Folder($this->id);
				break;
			case 'simple':
				$form = new \Cms\Form\Admin\Page\Article($this->id);
				break;
			default:
				$form = new \Cms\Form\Admin\Page\Cms($this->id);
				break;
		}
		if ($form->isSaved()) {
			return $this->_helper->redirector('index', 'admin-navigation', 'cms', array('id' => $form->getRecord()->parentId), true);
		}
		/* if ($this->id > 0) {
		  $record = \Cms\Model\Navigation\Dao::findPk($this->id);
		  if ($this->remove && $record) {
		  $parentId = $record->parentId;
		  $record->delete();
		  return $this->_helper->redirector('index', 'admin-navigation', 'cms', array('id' => $parentId), true);
		  }
		  } */
		$this->view->pageForm = $form;
	}

	/**
	 * Usuwanie elementu
	 */
	public function deleteAction() {
		$record = \Cms\Model\Navigation\Dao::findPk($this->id);
		if ($record !== null) {
			$record->delete();
		}
		return $this->_helper->redirector('index', 'admin-navigation', 'cms', array('id' => $record->parentId), true);
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
		\Cms\Model\Navigation\Dao::sortBySerial($order['navigation-item']);
		return '';
	}

}
