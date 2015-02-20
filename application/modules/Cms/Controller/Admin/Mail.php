<?php


namespace Cms\Controller\Admin;

class Mail extends \MmiCms\Controller\Admin {

	public function indexAction() {
		$this->view->grid = new \Cms\Plugin\MailGrid();
	}

	public function deleteAction() {
		$mail = \Cms\Model\Mail\Dao::findPk($this->id);
		if ($mail && $mail->delete()) {
			$this->_helper->messenger('Email został usunięty z kolejki', true);
		}
		return $this->_helper->redirector('index', 'admin', 'mail', array(), true);
	}

	public function sendAction() {
		$result = \Cms\Model\Mail\Dao::send();
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
