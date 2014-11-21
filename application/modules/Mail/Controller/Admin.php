<?php

class Mail_Controller_Admin extends MmiCms_Controller_Admin {

	public function indexAction() {
		$this->view->grid = new Mail_Plugin_Grid();
	}

	public function deleteAction() {
		$mail = new Mail_Model_Record($this->id);
		if ($mail->delete()) {
			$this->_helper->messenger('Email został usunięty z kolejki', true);
		}
		return $this->_helper->redirector('index', 'admin', 'mail', array(), true);
	}

	public function sendAction() {
		$result = Mail_Model_Dao::send();
		if ($result['success'] > 0) {
			$this->_helper->messenger('Maile z kolejki zostały wysłane', true);
		}
		if ($result['error'] > 0) {
			$this->_helper->messenger('Przy wysyłaniu wystąpiły błędy', false);
		}
		if ($result['success'] + $result['error'] == 0) {
			$this->_helper->messenger('Brak maili do wysyłki');
		}
		return $this->_helper->redirector('index');
	}

}
