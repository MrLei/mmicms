<?php

class Mail_Controller_AdminDefinition extends MmiCms_Controller_Admin {

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
		if ($definition->delete()) {
			$this->_helper->messenger('Poprawnie skasowano definicję maila');
		}
		return $this->_helper->redirector('index', 'adminDefinition', 'mail', array(), true);
	}

}