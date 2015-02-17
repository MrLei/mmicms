<?php

/**
 * MmiCMS
 */

/**
 * Kontroler administracyjny, rozszerza kontroler akcji
 */
class MmiCms_Controller_Admin Extends Mmi_Controller_Action {

	public function init() {

		//tylko rola admin
		if (!Default_Registry::$auth->hasRole('admin') && $this->getRequest()->action != 'login') {
			$this->_helper->redirector('login', 'admin', 'cms', array(), true);
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

		Mmi_Controller_Front::getInstance()->getRequest()
				->setParam('baseModule', 'cms')
				->setParam('baseController', 'admin');
	}

}
