<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Cms\Controller\Admin;

class Navigation extends \MmiCms\Controller\Admin {

	public function indexAction() {
		$config = new \Mmi\Navigation\Config();
		\Cms\Model\Navigation\Dao::decorateConfiguration($config);
		$this->view->navigation = $config->findById($this->id, true);
	}

	public function editAction() {
		$navRecord = new \Cms\Model\Navigation\Record($this->id);
		switch ($this->type) {
			case 'link':
				$form = new \Cms\Form\Admin\Page\Link($navRecord);
				break;
			case 'folder':
				$form = new \Cms\Form\Admin\Page\Folder($navRecord);
				break;
			case 'simple':
				$form = new \Cms\Form\Admin\Page\Article($navRecord);
				break;
			default:
				$form = new \Cms\Form\Admin\Page\Cms($navRecord);
				break;
		}
		if ($form->isSaved()) {
			return $this->_helper->redirector('index', 'admin-navigation', 'cms', array('id' => $navRecord->parentId), true);
		}
		$this->view->pageForm = $form;
	}

	/**
	 * Usuwanie elementu
	 */
	public function deleteAction() {
		/* @var $record \Cms\Model\Navigation\Record */
		$record = \Cms\Model\Navigation\Query::factory()->findPk($this->id);
		if ($record !== null) {
			$record->delete();
		}
		return $this->_helper->redirector('index', 'admin-navigation', 'cms', array('id' => $record->parentId), true);
	}

	public function sortAction() {
		$this->getResponse()->setTypePlain();
		$post = $this->getRequest()->getPost();
		if (!isset($post['navigation-item'])) {
			return $this->view->getTranslate()->_('Przenoszenie nie powiodło się');
		}
		\Cms\Model\Navigation\Dao::sortBySerial($post['navigation-item']);
		return '';
	}

}
