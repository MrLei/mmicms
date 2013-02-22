<?php

class Cms_Controller_AdminAuth extends MmiCms_Controller_Admin {

	public function indexAction() {
		$this->view->grid = new Cms_Plugin_AuthGrid();
	}

	public function editAction() {
		$form = new Cms_Form_Admin_Auth($this->_getParam('id'));
		if ($form->isSaved()) {
			$this->_helper->messenger('Poprawnie zapisano użytkownika', true);
			return $this->_helper->redirector('index');
		}
	}

	public function propertyAction() {
		$property = new Cms_Model_Property();
		$this->view->properties = $property->getProperties('cms_auth', null);
	}

	public function propertyEditAction() {
		$form = new Cms_Form_Property($this->_getParam('id'), array('object' => 'cms_auth', 'objectId' => null));
		if ($form->isSaved()) {
			return $this->_helper->redirector('property', 'adminAuth', 'cms', array(), true);
		}
	}

	public function propertyDeleteAction() {
		$property = new Cms_Model_Property($this->_getParam('id'));
		$property->delete();
		return $this->_helper->redirector('property', 'adminAuth', 'cms', array(), true);
	}

	/**
	 * Miękkie usuwanie użytkownika - przestawianie active na 0
	 */
	public function deleteAction() {
		if ($this->_getParam('id') > 0) {
			$model = new Cms_Model_Auth($this->_getParam('id'));
			$model->delete();
		}
		$this->_helper->messenger('Poprawnie skasowano użytkownika', true);
		return $this->_helper->redirector('index');
	}

}
