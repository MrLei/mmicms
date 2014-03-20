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
		if (!Default_Registry::$acl->isAllowed(Default_Registry::$auth->getRoles(), 'admin:index:index')) {
			$this->_helper->redirector('index', 'index', 'admin', array(), true);
		}
		
		$session = new Mmi_Session_Namespace('cms-language');
		$lang = in_array($session->lang, Default_Registry::$config->application->languages) ? $session->lang : null;
		Mmi_Controller_Front::getInstance()->getRequest()->lang = $lang;
		$request->lang = $lang;

		$this->view = Mmi_Controller_Front::getInstance()->getView();
		$this->view->baseSkin = Default_Registry::$config->application->skin;
		$this->view->baseModule = 'admin';

		$this->view->loggedUsername = Default_Registry::$auth->getUsername();
		$this->view->loggedRoles = implode(',', Default_Registry::$auth->getRoles());

		parent::__construct($request);
	}

}
