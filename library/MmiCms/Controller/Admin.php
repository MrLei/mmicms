<?php

/**
 * MmiCMS
 */

/**
 * Kontroler administracyjny, rozszerza kontroler akcji
 */
class MmiCms_Controller_Admin Extends Mmi_Controller_Action {

	public function __construct(Mmi_Controller_Request $request) {
		//acl dla admina
		$acl = Default_Registry::$acl;
		$this->view = Mmi_View::getInstance();
		if (!$acl->isAllowed(Mmi_Auth::getInstance()->getRoles(), 'admin:index:index')) {
			header('Location: ' . $this->view->baseUrl . '/admin');
			exit;
		}

		$this->view->baseSkin = Default_Registry::$config->application->skin;
		$this->view->baseModule = 'admin';

		$this->view->loggedUsername = Mmi_Auth::getInstance()->getUsername();
		$this->view->loggedRoles = implode(',', Mmi_Auth::getInstance()->getRoles());

		parent::__construct($request);
	}

}
