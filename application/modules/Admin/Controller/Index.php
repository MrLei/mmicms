<?php

class Admin_Controller_Index extends MmiCms_Controller_Admin {

	public function indexAction() {
		
	}

	public function passwordAction() {
		if (!Mmi_Auth::getInstance()->hasIdentity()) {
			$this->_helper->redirector('index', 'index', 'default', array(), true);
		}
		$form = new Admin_Form_Password();
		if (!$form->isMine()) {
			return;
		}
		if ($form->isSaved()) {
			Stat_Model_Dao::hit('admin_password', $form->getRecord()->id);
			$this->_helper->messenger('Hasło zmienione poprawnie, zaloguj się ponownie', true);
			//wylogowanie
			Mmi_Auth::getInstance()->clearIdentity();
			Stat_Model_Dao::hit('admin_logout');
			$this->_helper->redirector('index', 'index', 'admin', array(), true);
		}
	}

}