<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace MmiCms\Controller;

class Admin Extends \Mmi\Controller\Action {

	public function init() {
		//tylko rola admin
		if (!\Core\Registry::$auth->hasRole('admin') && $this->action != 'login') {
			$this->getResponse()->redirect('cms', 'admin', 'login');
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
