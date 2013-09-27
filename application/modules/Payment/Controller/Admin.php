<?php

class Payment_Controller_Admin extends MmiCms_Controller_Admin {

	public function indexAction() {
		$this->view->grid = new Payment_Plugin_Grid();
	}

	public function editAction() {
		if (!($this->_getParam('id') > 0)) {
			$this->_helper->redirector('index', 'admin', 'payment', array(), true);
		}
		$form = new Payment_Form_Admin_Payment($this->_getParam('id'));
		if ($form->isSaved()) {
			$this->_helper->messenger('Płatność zapisana poprawnie', true);
			$this->_helper->redirector('index', 'admin', 'payment', array(), true);
		}
	}

	public function deleteAction() {
		$payment = new Payment_Model_Payment($this->_getParam('id'));
		$payment->delete();
		$this->_helper->messenger('Usunięto płatność', true);
		$this->_helper->redirector('index', 'admin', 'payment', array(), true);
	}

}
