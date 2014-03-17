<?php

class User_Controller_Registration extends Mmi_Controller_Action {

	public function indexAction() {

		$form = new User_Form_Registration();

		if (!$form->isMine()) {
			return;
		}


		if ($form->isSaved()) {
			$this->_helper->messenger('Zarejestrowano poprawnie. Sprawdź e-mail i kliknij potwierdzenie konta.', true);
			return $this->_helper->redirector('index', 'index', 'default', array(), true);
		}

		$this->_helper->messenger('Formularz zawiera błędy', false);
		if ($form->getSaveResult() == -1) {
			$form->getElement('confirmPassword')->addError('Hasła niezgodne');
		}
	}

}
