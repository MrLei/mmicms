<?php

namespace Cms\Controller\Admin;

class MailServer extends \MmiCms\Controller\Admin {

	public function indexAction() {
		$grid = new \Cms\Plugin\MailServerGrid();
		$this->view->grid = $grid;
	}

	public function editAction() {
		$form = new \Cms\Form\Admin\Mail\Server($this->id);
		if ($form->isSaved()) {
			$this->_helper->messenger('Zapisano ustawienia serwera', true);
			$this->_helper->redirector('index', 'admin-mailServer', 'cms', array(), true);
		}
	}

	public function deleteAction() {
		$server = new \Cms\Model\Mail\Server\Record($this->id);
		try {
			if ($server && $server->delete()) {
				$this->_helper->messenger('Usunięto serwer');
			}
		} catch (\Exception $e) {
			if (stripos($e->getMessage(), 'DB exception') !== false) {
				$this->_helper->messenger('Nie można usunąć serwera, istnieją powiązane szablony', false);
			} else {
				throw $e;
			}
		}
		$this->_helper->redirector('index', 'admin-mailServer', 'cms', array(), true);
	}

}
