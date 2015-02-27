<?php

namespace Cms\Controller;

class User extends \Mmi\Controller\Action {

	public function loginAction() {
		$form = new \Cms\Form\Login();
		if (!$form->isMine()) {
			return;
		}
		if (!$form->isSaved()) {
			$this->_helper->messenger('Logowanie błędne', false);
			return;
		}
		$this->_helper->messenger('Zalogowano poprawnie', true);
		\Cms\Model\Stat\Dao::hit('user-login');
		$this->_helper->redirector()->gotoUrl($this->getRequest()->getReferer());
	}

	public function logoutAction() {
		\Core\Registry::$auth->clearIdentity();
		$this->_helper->messenger('Wylogowano poprawnie', true);
		\Cms\Model\Stat\Dao::hit('user-logout');
		$this->_helper->redirector()->gotoUrl($this->getRequest()->getReferer());
	}

	public function registerAction() {
		$form = new \Cms\Form\Register();
		if (!$form->isMine()) {
			return;
		}
		if ($form->isSaved()) {
			$this->_helper->messenger('Zarejestrowano poprawnie. Sprawdź e-mail i kliknij potwierdzenie konta.', true);
			\Cms\Model\Stat\Dao::hit('user-register');
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
