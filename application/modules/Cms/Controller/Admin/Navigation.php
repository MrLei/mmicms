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
			$this->getResponse()->redirect('cms', 'admin-navigation', 'index', array('id' => $navRecord->parentId));
		}
		$this->view->pageForm = $form;
	}

	/**
	 * Usuwanie elementu
	 */
	public function deleteAction() {
		/* @var $record \Cms\Model\Navigation\Record */
		$record = \Cms\Model\Navigation\Query::factory()->findPk($this->id);
		if ($record !== null && $record->delete()) {
			$this->getMessenger()->addMessage('Poprawnie usunięto element nawigacyjny', true);
		}
		$this->getResponse()->redirect('cms', 'admin-navigation', 'index', array('id' => $record->parentId));
	}

	public function sortAction() {
		$this->getResponse()->setTypePlain();
		if (!$this->getPost()->__get('navigation-item')) {
			return $this->view->getTranslate()->_('Przenoszenie nie powiodło się');
		}
		\Cms\Model\Navigation\Dao::sortBySerial($this->getPost()->__get('navigation-item'));
		return '';
	}

}
