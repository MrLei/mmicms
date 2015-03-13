<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Cms\Controller;

/**
 * Kontroler główny panelu administracyjnego
 */
class Admin extends \Cms\Controller\AdminAbstract {

	/**
	 * Strona główna admina
	 */
	public function indexAction() {
		
	}

	/**
	 * Logowanie
	 */
	public function loginAction() {
		$form = new \Cms\Form\Admin\Login($authRecord = new \Cms\Model\Auth\Record());
		$this->view->loginForm = $form;
		//brak wysłanych danych
		if (!$form->isMine()) {
			return;
		}
		//logowanie niepoprawne
		if (!$form->isSaved()) {
			$this->getMessenger()->addMessage('Logowanie niepoprawne', false);
			return;
		}
		//zalogowano
		$this->getMessenger()->addMessage('Zalogowano poprawnie', true);
		\Cms\Model\Stat\Dao::hit('admin-login', $authRecord->id);
		$this->getResponse()->redirectToUrl($this->getRequest()->getReferer());
	}

	/**
	 * Akcja wylogowania
	 */
	public function logoutAction() {
		\Core\Registry::$auth->clearIdentity();
		$this->getMessenger()->addMessage('Dziękujemy za skorzystanie z serwisu, wylogowanio poprawnie', true);
		//hit do statystyk
		\Cms\Model\Stat\Dao::hit('admin-logout');
		$this->getResponse()->redirect('cms', 'admin', 'index');
	}

	/**
	 * Akcja ustawiania języka (w sesji)
	 */
	public function languageAction() {
		$session = new \Mmi\Session\Space('cms-language');
		$lang = in_array($this->locale, \Core\Registry::$config->application->languages) ? $this->locale : null;
		$session->lang = $lang;
		$referer = \Mmi\Controller\Front::getInstance()->getRequest()->getReferer();
		//przekierowanie na referer
		if ($referer) {
			$this->getResponse()->redirectToUrl($referer);
		}
		$this->getResponse()->redirect('cms', 'admin', 'index');
	}

	/**
	 * Widget języków
	 */
	public function languageWidgetAction() {
		$this->view->languages = \Core\Registry::$config->application->languages;
	}

	/**
	 * Zmiana hasła
	 */
	public function passwordAction() {
		//użytkownik niezalogowany
		if (!\Core\Registry::$auth->hasIdentity()) {
			$this->getResponse()->redirect('core', 'index', 'index');
		}
		$form = new \Cms\Form\Admin\Password($authRecord = new \Cms\Model\Auth\Record());
		$this->view->passwordForm = $form;
		//brak wysłanych danych
		if (!$form->isMine()) {
			return;
		}
		//hasło niepoprawne (nowe lub stare)
		if (!$form->isSaved()) {
			return;
		}
		//hit do statystyk
		\Cms\Model\Stat\Dao::hit('admin_password', $authRecord->id);
		$this->getMessenger()->addMessage('Hasło zmienione poprawnie, zaloguj się ponownie');
		//wylogowanie
		\Core\Registry::$auth->clearIdentity();
		\Cms\Model\Stat\Dao::hit('admin_logout');
		$this->getResponse()->redirect('cms', 'admin', 'index');
		
	}

}
