<?php

class Cms_Controller_AdminContainerTemplatePlaceholderContainer extends MmiCms_Controller_Admin {

	public function indexAction() {
		$this->view->grid = new Cms_Plugin_ContainerTemplatePlaceholderContainerGrid();
		//placeholdery tylko dla danego szablonu
		if ($this->containerId) {
			$q = new Mmi_Dao_Query();
			$q->where('cms_container_id')->equals($this->containerId);
			$this->view->grid->setInitialQuery($q);
		}
	}

	public function editAction() {
		$form = new Cms_Form_Admin_Container_Template_Placeholder_Container($this->id, array('containerId' => $this->containerId));
		if ($form->isSaved()) {
			$this->_helper->messenger('Placeholder zapisany poprawnie', true);
			$this->_helper->redirector('edit', 'adminContainer', 'cms', array('id' => $form->getRecord()->cms_container_id), true);
		}
	}

	public function deleteAction() {
		$record = Cms_Model_Container_Template_Placeholder_Container_Dao::findPk($this->id);
		if ($record && $record->delete()) {
			$this->_helper->messenger('Poprawnie usunięto placeholder', true);
		}
		$this->_helper->redirector('edit', 'adminContainer', 'cms', array('id' => $record->cms_container_id), true);
	}

}
