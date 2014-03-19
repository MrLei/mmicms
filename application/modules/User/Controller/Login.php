<?php
class User_Controller_Login extends Mmi_Controller_Action {

	public function indexAction() {
		$form = new User_Form_Login();
		if (!$form->isMine()) {
			return;
		}
		if (!$form->isSaved()) {
			$this->_helper->messenger('Logowanie błędne', false);
			return;
		}
		$this->_helper->messenger('Zalogowano poprawnie', true);
		$this->_helper->redirector()->gotoUrl($this->getRequest()->getReferer());
	}


	public function logoutAction() {
		Default_Registry::$auth->clearIdentity();
		$this->_helper->messenger('Wylogowano poprawnie', true);
		$this->_helper->redirector()->gotoUrl($this->getRequest()->getReferer());
	}

	public function widgetAction() {
		$this->indexAction();
	}

}