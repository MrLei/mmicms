<?php

/**
 * MmiCMS
 */

/**
 * Kontroler administracyjny, rozszerza kontroler akcji
 */
class MmiCms_Controller_Admin Extends Mmi_Controller_Action {

	public function init() {

		//acl dla admina
		if (!Default_Registry::$acl->isAllowed(Default_Registry::$auth->getRoles(), 'admin:index:index')) {
			$this->_helper->redirector('index', 'index', 'admin', array(), true);
		}

		//ustawienie języka edycji
		$session = new Mmi_Session_Namespace('cms-language');
		$lang = in_array($session->lang, Default_Registry::$config->application->languages) ? $session->lang : null;
		if ($lang === null && isset(Default_Registry::$config->application->languages[0])) {
			$lang = Default_Registry::$config->application->languages[0];
		}
		unset($this->getRequest()->lang);
		unset(Mmi_Controller_Front::getInstance()->getRequest()->lang);
		if ($lang !== null) {
			Mmi_Controller_Front::getInstance()->getRequest()->lang = $lang;
			$this->getRequest()->lang = $lang;
		}

		$this->view = Mmi_Controller_Front::getInstance()->getView();
		$this->view->baseSkin = Default_Registry::$config->application->skin;
		$this->view->baseModule = 'admin';
	}

}
