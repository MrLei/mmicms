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
		if (!$form->isMine()) {
			return;
		}
		if ($form->isSaved()) {
			$this->_helper->messenger('Zalogowano poprawnie', true);
			\Cms\Model\Stat\Dao::hit('admin-login', $authRecord->id);
		} else {
			$this->_helper->messenger('Logowanie niepoprawne', false);
		}
		$baseUri = $this->view->url(array('module' => 'cms', 'controller' => 'admin', 'action' => 'login'));
		$requestUri = \Mmi\Controller\Front::getInstance()->getEnvironment()->requestUri;
		$uri = ($requestUri != $baseUri) ? $requestUri : $this->view->url(array('module' => 'cms', 'controller' => 'admin', 'action' => 'index'));
		$this->_helper->redirector()->gotoUrl($uri);
	}

	public function logoutAction() {
		\Core\Registry::$auth->clearIdentity();
		$this->_helper->messenger('Dziękujemy za skorzystanie z serwisu, wylogowanio poprawnie', true);
		\Cms\Model\Stat\Dao::hit('admin-logout');
		$this->_helper->redirector('index', 'admin', 'cms', array(), true);
	}

	public function languageAction() {
		$session = new \Mmi\Session\Space('cms-language');
		$lang = in_array($this->locale, \Core\Registry::$config->application->languages) ? $this->locale : null;
		$session->lang = $lang;
		$referer = \Mmi\Controller\Front::getInstance()->getRequest()->getReferer();
		if ($referer) {
			$this->_helper->redirector()->gotoUrl($referer);
		}
		$this->_helper->redirector('index', 'admin', 'cms', array(), true);
	}

	public function languageWidgetAction() {
		$this->view->languages = \Core\Registry::$config->application->languages;
	}

	public function passwordAction() {
		if (!\Core\Registry::$auth->hasIdentity()) {
			$this->_helper->redirector('index', 'index', 'core', array(), true);
		}
		$form = new \Cms\Form\Admin\Password($authRecord = new \Cms\Model\Auth\Record());
		if (!$form->isMine()) {
			return;
		}
		if ($form->isSaved()) {
			\Cms\Model\Stat\Dao::hit('admin_password', $authRecord->id);
			$this->_helper->messenger('Hasło zmienione poprawnie, zaloguj się ponownie');
			//wylogowanie
			\Core\Registry::$auth->clearIdentity();
			\Cms\Model\Stat\Dao::hit('admin_logout');
			$this->_helper->redirector('index', 'admin', 'cms', array(), true);
		}
	}

}
