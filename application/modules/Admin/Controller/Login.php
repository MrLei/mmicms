<?php

class Admin_Controller_Login extends Mmi_Controller_Action {

	public function indexAction() {
		if (Mmi_Auth::getInstance()->hasIdentity()) {
			$this->_helper->redirector('index', 'index', 'default', array(), true);
		}
		$form = new Admin_Form_Login();
		if (!$form->isMine()) {
			return;
		}
		if ($form->isSaved()) {
			Stat_Model_Dao::hit('admin_login', $form->getRecord()->id);
			$this->_helper->messenger('Zalogowano poprawnie', true);
		} else {
			$this->_helper->messenger('Logowanie niepoprawne', false);
		}
		$this->_helper->redirector('index', 'index', 'admin', array(), true);
	}
	
	public function logoutAction() {
		Mmi_Auth::getInstance()->clearIdentity();
		Stat_Model_Dao::hit('admin_logout');
		$this->_helper->messenger('Dziękujemy za skorzystanie z serwisu, wylogowanio poprawnie');
		$this->_helper->redirector('index', 'index', 'admin', array(), true);
	}

}