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
		$this->view = Mmi_View::getInstance();
		if (!Default_Registry::$acl->isAllowed(Default_Registry::$auth->getRoles(), 'admin:index:index')) {
			header('Location: ' . $this->view->baseUrl . '/admin');
			exit;
		}

		$this->view->baseSkin = Default_Registry::$config->application->skin;
		$this->view->baseModule = 'admin';

		$this->view->loggedUsername = Default_Registry::$auth->getUsername();
		$this->view->loggedRoles = implode(',', Default_Registry::$auth->getRoles());

		parent::__construct($request);
	}

}
