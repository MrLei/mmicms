<?php
class User_Controller_Registration extends Mmi_Controller_Action {

	public function indexAction() {

		$form = new User_Form_Registration();

		if ($form->isSaved()) {
			$this->_helper->messenger('Zarejestrowano poprawnie. Sprawdź e-mail i kliknij potwierdzenie konta.', true);
			return $this->_helper->redirector('index', 'index', 'default', array(), true);
		}

		if ($this->getRequest()->isPost() && $form->isMine()) {
			$this->_helper->messenger('Formularz zawiera błędy', false);
			if ($form->getValue('password') != $form->getValue('confirmPassword')) {
				$form->getElement('confirmPassword')->addError('Hasła niezgodne');
			}
			if ($form->getValue('regulations') != 1) {
				$form->getElement('regulations')->addError('Wymagana jest akceptacja regulaminu.');
			}
		}

	}

}
