<?php

class Cms_Controller_Admin_MailDefinition extends MmiCms_Controller_Admin {

	public function indexAction() {
		$grid = new Cms_Plugin_MailDefinitionGrid();
		$this->view->grid = $grid;
	}

	public function editAction() {
		$form = new Cms_Form_Admin_Mail_Definition($this->id);
		if ($form->isSaved()) {
			$this->_helper->messenger('Poprawnie zapisano definicję maila', true);
			$this->_helper->redirector('index', 'admin-mailDefinition', 'cms', array(), true);
		}
	}

	public function deleteAction() {
		$definition = Cms_Model_Mail_Definition_Dao::findPk($this->id);
		try {
			if ($definition && $definition->delete()) {
				$this->_helper->messenger('Poprawnie skasowano definicję maila');
			}
		} catch (Mmi_Db_Exception $e) {
			$this->_helper->messenger('Nie można usunąć definicji maila, istnieją powiazane wiadomosci w kolejce', false);
		}
		$this->_helper->redirector('index', 'admin-mailDefinition', 'cms', array(), true);
	}

}
