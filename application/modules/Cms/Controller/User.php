<?php

class Cms_Controller_User extends Mmi_Controller_Action {

	public function loginAction() {
		$form = new Cms_Form_Login();
		if (!$form->isMine()) {
			return;
		}
		if (!$form->isSaved()) {
			$this->_helper->messenger('Logowanie błędne', false);
			return;
		}
		$this->_helper->messenger('Zalogowano poprawnie', true);
		Stat_Model_Dao::hit('user-login');
		$this->_helper->redirector()->gotoUrl($this->getRequest()->getReferer());
	}

	public function logoutAction() {
		Default_Registry::$auth->clearIdentity();
		$this->_helper->messenger('Wylogowano poprawnie', true);
		Stat_Model_Dao::hit('user-logout');
		$this->_helper->redirector()->gotoUrl($this->getRequest()->getReferer());
	}
	
	public function registerAction() {
		$form = new Cms_Form_Register();
		if (!$form->isMine()) {
			return;
		}
		if ($form->isSaved()) {
			$this->_helper->messenger('Zarejestrowano poprawnie. Sprawdź e-mail i kliknij potwierdzenie konta.', true);
			Stat_Model_Dao::hit('user-register');
			return $this->_helper->redirector('index', 'index', 'default', array(), true);
		}
		$this->_helper->messenger('Formularz zawiera błędy', false);
		if ($form->getSaveResult() == -1) {
			$form->getElement('confirmPassword')->addError('Hasła niezgodne');
		}
	}
	
	public function loginWidgetAction() {
		return $this->loginAction();
	}

}
