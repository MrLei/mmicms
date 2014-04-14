<?php

class Cms_Controller_AdminContainerTemplatePlaceholder extends MmiCms_Controller_Admin {

	public function indexAction() {
		$this->view->grid = new Cms_Plugin_ContainerTemplatePlaceholderGrid();
		//placeholdery tylko dla danego szablonu
		if ($this->_getParam('templateId')) {
			$q = new Mmi_Dao_Query();
			$q->where('cms_container_template_id')->equals($this->_getParam('templateId'));
			$this->view->grid->setInitialQuery($q);
		}
	}

	public function editAction() {
		$form = new Cms_Form_Admin_Container_Template_Placeholder($this->_getParam('id'), array('templateId' => $this->_getParam('templateId')));
		if (!$form->isMine()) {
			return;
		}
		if ($form->isSaved()) {
			$this->_helper->messenger('Placeholder zapisany poprawnie', true);
			$this->_helper->redirector('edit', 'adminContainerTemplate', 'cms', array('id' => $form->getRecord()->cms_container_template_id), true);
		}
		$this->_helper->messenger('Placeholder o tym samym kluczu już istnieje', false);
	}

	public function deleteAction() {
		$record = Cms_Model_Container_Template_Placeholder_Dao::findPk($this->_getParam('id'));
		if ($record && $record->delete()) {
			$this->_helper->messenger('Poprawnie usunięto placeholder', true);
		}
		$this->_helper->redirector('edit', 'adminContainerTemplate', 'cms', array('id' => $record->cms_container_template_id), true);
	}

}
