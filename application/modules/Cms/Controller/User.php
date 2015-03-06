<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Cms\Controller;

class User extends \Mmi\Controller\Action {

	public function loginAction() {
		$form = new \Cms\Form\Login(new \Cms\Model\Auth\Record());
		$this->view->loginForm = $form;
		if (!$form->isMine()) {
			return;
		}
		if (!$form->isSaved()) {
			$this->getMessenger()->addMessage('Logowanie błędne', false);
			return;
		}
		$this->getMessenger()->addMessage('Zalogowano poprawnie', true);
		\Cms\Model\Stat\Dao::hit('user-login');
		$this->getResponse()->redirectToUrl($this->getRequest()->getReferer());
	}

	public function logoutAction() {
		\Core\Registry::$auth->clearIdentity();
		$this->getMessenger()->addMessage('Wylogowano poprawnie', true);
		\Cms\Model\Stat\Dao::hit('user-logout');
		$this->getResponse()->redirectToUrl($this->getRequest()->getReferer());
	}

	public function registerAction() {
		$form = new \Cms\Form\Register();
		$this->view->registerForm = $form;
		if (!$form->isMine()) {
			return;
		}
		if ($form->isSaved()) {
			$this->getMessenger()->addMessage('Zarejestrowano poprawnie. Sprawdź e-mail i kliknij potwierdzenie konta.', true);
			\Cms\Model\Stat\Dao::hit('user-register');
			$this->getResponse()->redirect('default', 'index', 'index');
		}
		$this->getMessenger()->addMessage('Formularz zawiera błędy', false);
		if ($form->getRecord()->getSaveResult() == -1) {
			$form->getElement('confirmPassword')->addError('Hasła niezgodne');
		}
	}

	public function loginWidgetAction() {
		return $this->loginAction();
	}

}
