<?php

class Admin_Controller_Login extends Mmi_Controller_Action {

	public function indexAction() {
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
		$baseUri = $this->view->url(array('module' => 'admin', 'controller' => 'login', 'action' => 'index'));
		$requestUri = Mmi_Controller_Front::getInstance()->getEnvironment()->requestUri;
		$uri = ($requestUri != $baseUri) ? $requestUri : $this->view->url(array('module' => 'admin', 'controller' => 'index', 'action' => 'index'));
		$this->_helper->redirector()->gotoUrl($uri);
	}

	public function logoutAction() {
		Default_Registry::$auth->clearIdentity();
		Stat_Model_Dao::hit('admin_logout');
		$this->_helper->messenger('Dziękujemy za skorzystanie z serwisu, wylogowanio poprawnie', true);
		$this->_helper->redirector('index', 'index', 'admin', array(), true);
	}

}