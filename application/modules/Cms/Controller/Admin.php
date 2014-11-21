<?php

class Cms_Controller_Admin extends MmiCms_Controller_Admin {

	public function languageAction() {
		$session = new Mmi_Session_Namespace('cms-language');
		$lang = in_array($this->locale, Default_Registry::$config->application->languages) ? $this->locale : null;
		$session->lang = $lang;
		$referer = Mmi_Controller_Front::getInstance()->getRequest()->getReferer();
		if ($referer) {
			$this->_helper->redirector()->gotoUrl($referer);
		}
		$this->_helper->redirector('index', 'index', 'admin', array(), true);
	}

	public function languageWidgetAction() {
		$this->view->languages = Default_Registry::$config->application->languages;
	}

	public function passwordAction() {
		if (!Default_Registry::$auth->hasIdentity()) {
			$this->_helper->redirector('index', 'index', 'default', array(), true);
		}
		$form = new Admin_Form_Password();
		if (!$form->isMine()) {
			return;
		}
		if ($form->isSaved()) {
			Stat_Model_Dao::hit('admin_password', $form->getRecord()->id);
			$this->_helper->messenger('Hasło zmienione poprawnie, zaloguj się ponownie');
			//wylogowanie
			Default_Registry::$auth->clearIdentity();
			Stat_Model_Dao::hit('admin_logout');
			$this->_helper->redirector('index', 'index', 'admin', array(), true);
		}
	}

}
