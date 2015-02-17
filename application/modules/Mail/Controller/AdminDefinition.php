<?php

class Mail_Controller_Admin_Definition extends MmiCms_Controller_Admin {

	public function indexAction() {
		$grid = new Mail_Plugin_DefinitionGrid();
		$this->view->grid = $grid;
	}

	public function editAction() {
		$form = new Mail_Form_Admin_Definition($this->id);
		if ($form->isSaved()) {
			$this->_helper->messenger('Poprawnie zapisano definicję maila', true);
			return $this->_helper->redirector('index', 'adminDefinition', 'mail', array(), true);
		}
	}

	public function deleteAction() {
		$definition = new Mail_Model_Definition_Record($this->id);
		try {
			if ($definition && $definition->delete()) {
				$this->_helper->messenger('Poprawnie skasowano definicję maila');
			}
		} catch (Exception $e) {
			if (stripos($e->getMessage(), 'DB exception') !== false) {
				$this->_helper->messenger('Nie można usunąć definicji maila, istnieją powiazane wiadomosci w kolejce', false);
			} else {
				throw $e;
			}
		}
		return $this->_helper->redirector('index', 'adminDefinition', 'mail', array(), true);
	}

}
