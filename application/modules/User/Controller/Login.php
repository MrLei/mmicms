<?php
class User_Controller_Login extends Mmi_Controller_Action {

	public function indexAction() {
		new User_Form_Login();
		if (empty($_POST)) {
			return;
		}
		$auth = new Cms_Model_Auth();
		if (false === $auth->login($_POST)) {
			$this->_helper->messenger('Logowanie niepoprawne', false);
			return $this->_helper->redirector('index', 'login', 'user', array(), true);
		} else {
			Stat_Model_Stat::hit('user_login');
			$this->_helper->messenger('Zalogowano poprawnie', true);
			$user = new User_Model_Profile($auth->getId());
			Mmi_Cache::save($user, 'Profile_' . $user->getId(), 28800);
		}
		if (strpos($this->getRequest()->getReferer(), 'zaloguj') === false && strpos($this->getRequest()->getReferer(), 'rejestracja') === false) {
			$this->_helper->redirector()->gotoUrl($this->getRequest()->getReferer());
		} else {
			return $this->_helper->redirector('index', 'index', 'default', array(), true);
		}
	}


	public function logoutAction() {
		Default_Registry::$auth->clearIdentity();
		$this->_helper->messenger('Wylogowano poprawnie');
		$this->_helper->redirector()->gotoUrl($this->getRequest()->getReferer());
	}

	public function widgetAction() {
		Mmi_View_Layout::getInstance()->setDisabled();
		$form = new User_Form_Login();
		if ($this->_getParam('_widget')) {
			$form->setAction($this->view->url($this->getRequest()->getParams(), true, true));
		}
		if (!$form->isMine()) {
			return;
		}
		$auth = new Cms_Model_Auth();
		if (false === $auth->login($form->getValues())) {

		}
		$this->_helper->redirector()->gotoUrl($this->getRequest()->getReferer());
	}

}