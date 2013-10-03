<?php

class Cms_Controller_AdminContainerTemplatePlaceholder extends MmiCms_Controller_Admin {

	public function indexAction() {
		$this->view->grid = new Cms_Plugin_ContainerTemplatePlaceholderGrid();
		//placeholdery tylko dla danego szablonu
		if ($this->_getParam('templateId')) {
			$this->view->grid->setOption('bind', array(array('cms_container_template_id', $this->_getParam('templateId'), '=')));
		}
	}

	public function editAction() {
		$form = new Cms_Form_Admin_Container_Template_Placeholder($this->_getParam('id'), array('templateId' => $this->_getParam('templateId')));
		if ($form->isSaved()) {
			$this->_helper->messenger('Placeholder zapisany poprawnie', true);
			$this->_helper->redirector('edit', 'adminContainerTemplate', 'cms', array('id' => $form->getRecord()->cms_container_template_id), true);
		}
	}

	public function deleteAction() {
		$record = Cms_Model_Container_Template_Placeholder_Dao::findPk($this->_getParam('id'));
		if ($record && $record->delete()) {
			$this->_helper->messenger('Poprawnie usunięto placeholder', true);
		}
		$this->_helper->redirector('edit', 'adminContainerTemplate', 'cms', array('id' => $record->cms_container_template_id), true);
	}

}
