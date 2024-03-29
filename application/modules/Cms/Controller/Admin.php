<?php

class Cms_Controller_Admin extends MmiCms_Controller_Admin {

	public function indexAction() {
	
	}
	
	public function loginAction() {
		$form = new Cms_Form_Admin_Login();
		if (!$form->isMine()) {
			return;
		}
		if ($form->isSaved()) {
			$this->_helper->messenger('Zalogowano poprawnie', true);
			Cms_Model_Stat_Dao::hit('admin-login', $form->getRecord()->id);
		} else {
			$this->_helper->messenger('Logowanie niepoprawne', false);
		}
		$baseUri = $this->view->url(array('module' => 'cms', 'controller' => 'admin', 'action' => 'login'));
		$requestUri = Mmi_Controller_Front::getInstance()->getEnvironment()->requestUri;
		$uri = ($requestUri != $baseUri) ? $requestUri : $this->view->url(array('module' => 'cms', 'controller' => 'admin', 'action' => 'index'));
		$this->_helper->redirector()->gotoUrl($uri);
	}

	public function logoutAction() {
		Default_Registry::$auth->clearIdentity();
		$this->_helper->messenger('Dziękujemy za skorzystanie z serwisu, wylogowanio poprawnie', true);
		Cms_Model_Stat_Dao::hit('admin-logout');
		$this->_helper->redirector('index', 'admin', 'cms', array(), true);
	}

	public function languageAction() {
		$session = new Mmi_Session_Namespace('cms-language');
		$lang = in_array($this->locale, Default_Registry::$config->application->languages) ? $this->locale : null;
		$session->lang = $lang;
		$referer = Mmi_Controller_Front::getInstance()->getRequest()->getReferer();
		if ($referer) {
			$this->_helper->redirector()->gotoUrl($referer);
		}
		$this->_helper->redirector('index', 'admin', 'cms', array(), true);
	}

	public function languageWidgetAction() {
		$this->view->languages = Default_Registry::$config->application->languages;
	}

	public function passwordAction() {
		if (!Default_Registry::$auth->hasIdentity()) {
			$this->_helper->redirector('index', 'index', 'default', array(), true);
		}
		$form = new Cms_Form_Admin_Password();
		if (!$form->isMine()) {
			return;
		}
		if ($form->isSaved()) {
			Cms_Model_Stat_Dao::hit('admin_password', $form->getRecord()->id);
			$this->_helper->messenger('Hasło zmienione poprawnie, zaloguj się ponownie');
			//wylogowanie
			Default_Registry::$auth->clearIdentity();
			Cms_Model_Stat_Dao::hit('admin_logout');
			$this->_helper->redirector('index', 'admin', 'cms', array(), true);
		}
	}
	
}
