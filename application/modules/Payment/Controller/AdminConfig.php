<?php

class Payment_Controller_AdminConfig extends MmiCms_Controller_Admin {

	public function indexAction() {
		$this->view->grid = new Payment_Plugin_ConfigGrid();
	}

	public function editAction() {
		$form = new Payment_Form_Admin_Config($this->_getParam('id'));
		if ($form->isSaved()) {
			$offer = new Payment_Model_Config($this->_getParam('id'));
			$this->_helper->messenger('Konfiguracja płatności zapisana poprawnie', true);
			$this->_helper->redirector('index', 'adminConfig', 'payment', array(), true);
		}
	}

	public function deleteAction() {
		$config = new Payment_Model_Config($this->_getParam('id'));
		try {
			$config->delete();
			$this->_helper->messenger('Konfiguracja płatności została usunięta', true);
		} catch (Exception $e) {
			$this->_helper->messenger('Konfiguracja jest w użyciu', false);
		}
		$this->_helper->redirector('index', 'adminConfig', 'payment', array(), true);
	}

}
