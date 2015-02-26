<?php

/**
 * MmiCMS
 */
/**
 * Kontroler administracyjny, rozszerza kontroler akcji
 */

namespace MmiCms\Controller;

class Admin Extends \Mmi\Controller\Action {

	public function init() {
		//tylko rola admin
		if (!\Core\Registry::$auth->hasRole('admin') && $this->getRequest()->action != 'login') {
			$this->_helper->redirector('login', 'admin', 'cms', array(), true);
		}

		//ustawienie języka edycji
		$session = new \Mmi\Session\Space('cms-language');
		$lang = in_array($session->lang, \Core\Registry::$config->application->languages) ? $session->lang : null;
		if ($lang === null && isset(\Core\Registry::$config->application->languages[0])) {
			$lang = \Core\Registry::$config->application->languages[0];
		}
		unset($this->getRequest()->lang);
		unset(\Mmi\Controller\Front::getInstance()->getRequest()->lang);
		if ($lang !== null) {
			\Mmi\Controller\Front::getInstance()->getRequest()->lang = $lang;
			$this->getRequest()->lang = $lang;
		}
		\Core\Registry::setVar('adminPage', true);
	}

}
