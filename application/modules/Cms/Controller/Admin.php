<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Cms\Controller;

class Admin extends \MmiCms\Controller\Admin {

	public function indexAction() {
		
	}

	public function loginAction() {
		$form = new \Cms\Form\Admin\Login($authRecord = new \Cms\Model\Auth\Record());
		$this->view->loginForm = $form;
		if (!$form->isMine()) {
			return;
		}
		if (!$form->isSaved()) {
			$this->getMessenger()->addMessage('Logowanie niepoprawne', false);
		}
		$this->getMessenger()->addMessage('Zalogowano poprawnie', true);
		\Cms\Model\Stat\Dao::hit('admin-login', $authRecord->id);
		$this->getResponse()->redirectToUrl($this->getRequest()->getReferer());
	}

	public function logoutAction() {
		\Core\Registry::$auth->clearIdentity();
		$this->getMessenger()->addMessage('Dziękujemy za skorzystanie z serwisu, wylogowanio poprawnie', true);
		\Cms\Model\Stat\Dao::hit('admin-logout');
		$this->getResponse()->redirect('cms', 'admin', 'index');
	}

	public function languageAction() {
		$session = new \Mmi\Session\Space('cms-language');
		$lang = in_array($this->locale, \Core\Registry::$config->application->languages) ? $this->locale : null;
		$session->lang = $lang;
		$referer = \Mmi\Controller\Front::getInstance()->getRequest()->getReferer();
		if ($referer) {
			$this->getResponse()->redirectToUrl($referer);
		}
		$this->getResponse()->redirect('cms', 'admin', 'index');
	}

	public function languageWidgetAction() {
		$this->view->languages = \Core\Registry::$config->application->languages;
	}

	public function passwordAction() {
		if (!\Core\Registry::$auth->hasIdentity()) {
			$this->getResponse()->redirect('core', 'index', 'index');
		}
		$form = new \Cms\Form\Admin\Password($authRecord = new \Cms\Model\Auth\Record());
		$this->view->passwordForm = $form;
		if (!$form->isMine()) {
			return;
		}
		if ($form->isSaved()) {
			\Cms\Model\Stat\Dao::hit('admin_password', $authRecord->id);
			$this->getMessenger()->addMessage('Hasło zmienione poprawnie, zaloguj się ponownie');
			//wylogowanie
			\Core\Registry::$auth->clearIdentity();
			\Cms\Model\Stat\Dao::hit('admin_logout');
			$this->getResponse()->redirect('cms', 'admin', 'index');
		}
	}

}
