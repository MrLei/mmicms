<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Cms\Controller\Admin;

class File extends \Cms\Controller\AdminAbstract {

	public function indexAction() {
		$this->view->grid = new \Cms\Plugin\FileGrid();
	}

	public function stickAction() {
		$this->getResponse()->setTypePlain();
		if (!$this->id) {
			return '';
		}
		$file = \Cms\Model\File\Query::factory()->findPk($this->id);
		if (!$file || $this->hash != $file->name) {
			return $this->view->getTranslate()->_('Przypinanie nie powiodło się');
		}
		$file->setSticky();
		return '';
	}

	public function editAction() {
		$this->getResponse()->setTypeJson();
		if (!$this->id) {
			return $this->view->getTranslate()->_('Edycja nie powiodła się, brak pliku');
		}
		$file = \Cms\Model\File\Query::factory()->findPk($this->id);
		if (!$file) {
			return '';
		}
		if (!empty($this->getPost())) {
			if ($this->hash != $file->getHashName()) {
				return $this->view->getTranslate()->_('Edycja nie powiodła się');
			}
			$file->setFromArray($this->getPost()->toArray());
			$file->save();
			return '';
		}
		if ($this->hash != $file->getHashName()) {
			return json_encode(array('error' => 'Brak pliku'));
		}
		return $file->toJson();
	}

	public function removeAction() {
		$file = \Cms\Model\File\Query::factory()->findPk($this->id);
		if ($file && $file->delete()) {
			$file->delete();
			$this->getMessenger()->addMessage('Poprawnie usunięto plik', true);
		}
		$this->getResponse()->redirect('cms', 'admin-file', 'index');
	}

	public function deleteAction() {
		$this->getResponse()->setTypePlain();
		if (!$this->id > 0) {
			return $this->view->getTranslate()->_('Usuwanie nie powiodło się, brak pliku');
		}
		$file = \Cms\Model\File\Query::factory()->findPk($this->id);
		if (!$file || $this->hash != $file->getHashName()) {
			return $this->view->getTranslate()->_('Usuwanie nie powiodło się');
		}
		$file->delete();
		return '';
	}

	public function sortAction() {
		$this->getResponse()->setTypePlain();
		if (!$this->getPost()->__get('item-file')) {
			return $this->view->getTranslate()->_('Przenoszenie nie powiodło się');
		}
		\Cms\Model\File\Dao::sortBySerial($this->getPost()->__get('item-file'));
		return '';
	}

}
