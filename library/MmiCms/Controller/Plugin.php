<?php

/**
 * MmiCMS
 */

/**
 * Wtyczka FC
 */
class MmiCms_Controller_Plugin extends Mmi_Controller_Plugin_Abstract {

	public function routeStartup(Mmi_Controller_Request $request) {
		//route z cms
		if (null === ($routes = Default_Registry::$cache->load('Mmi_Route'))) {
			$routes = Cms_Model_Route_Dao::findActive();
			Default_Registry::$cache->save($routes, 'Mmi_Route', 86400);
		}
	}

	public function preDispatch(Mmi_Controller_Request $request) {

		//niepoprawny język
		if ($request->__get('lang') && !in_array($request->__get('lang'), Default_Registry::$config->application->languages)) {
			Mmi_Controller_Front::getInstance()->getResponse()->setCode(404);
			$request->lang = Default_Registry::$config->application->languages[0];
			$request->setModuleName('default');
			$request->setControllerName('error');
			$request->setActionName('index');
		}

		//brak komponentu (moduł + kontroler + akcja)
		$components = Mmi_Controller_Front::getInstance()->getStructure('module');
		if (!isset($components[$request->getModuleName()][$request->getControllerName()][$request->getActionName()])) {
			Mmi_Controller_Front::getInstance()->getResponse()->setCode(404);
			$request->setModuleName('default');
			$request->setControllerName('error');
			$request->setActionName('index');
		}

		//ustawianie sesji
		if (Default_Registry::$config->session->name) {
			require LIB_PATH . '/Mmi/Session.php';
			require LIB_PATH . '/Mmi/Session/Namespace.php';
			Mmi_Session::start(Default_Registry::$config->session);
		}

		//ustawienie widoku
		$view = Mmi_Controller_Front::getInstance()->getView();
		$base = $view->baseUrl;
		$view->domain = Default_Registry::$config->application->host;
		$view->mediaServer = Default_Registry::$config->media->mediaServer;

		$jsReqestArray = array();
		$jsReqestArray[] = "'baseUrl' : '" . $base . "'";
		$filter = new Mmi_Filter_Urlencode();
		foreach ($request->getParams() as $param => $value) {
			if ($param == 'controller' || $param == 'action') {
				continue;
			}
			if (is_array($value)) {
				$value = json_encode($value);
			} else {
				$value = '\'' . $filter->filter($value) . '\'';
			}
			$jsReqestArray[] = "'" . $filter->filter($param) . "' : " . $value;
		}
		$jsRequest = "		var request = {\n		" . implode(",\n		", $jsReqestArray) . "\n		};";
		$view->headScript()->appendScript($jsRequest);

		//konfiguracja autoryzacji
		$auth = new Mmi_Auth();
		$auth->setSalt(Default_Registry::$config->application->salt);
		$auth->setModelName(Default_Registry::$config->session->authModel ? Default_Registry::$config->session->authModel : 'Cms_Model_Auth');
		Default_Registry::$auth = $auth;

		$cookie = new Mmi_Http_Cookie();
		$remember = Default_Registry::$config->session->authRemember ? Default_Registry::$config->session->authRemember : 0;
		if ($remember > 0 && !$auth->hasIdentity() && $cookie->match('remember')) {
			$params = array();
			parse_str($cookie->getValue(), $params);
			if (isset($params['id']) && isset($params['key']) && $params['key'] == md5(Default_Registry::$config->application->salt . $params['id'])) {
				$auth->setIdentity($params['id']);
				$auth->idAuthenticate();
			}
		}
		if ($auth->hasIdentity()) {
			$view->auth = $auth;
		}

		//ustawienie acl
		if (null === ($acl = Default_Registry::$cache->load('Mmi_Acl'))) {
			Mmi_Profiler::event('Init Acl');
			$acl = Cms_Model_Acl_Dao::setupAcl();
			Default_Registry::$cache->save($acl, 'Mmi_Acl', 86400);
		}

		Mmi_Controller_Action_Helper_Action::setAcl($acl);
		Mmi_Controller_Action_Helper_Action::setAuth($auth);
		Default_Registry::$acl = $acl;

		//zablokowane na ACL
		if (!$acl->isAllowed($auth->getRoles(), strtolower($request->getModuleName() . ':' . $request->getControllerName() . ':' . $request->getActionName()))) {
			if (!$auth->hasIdentity() && (substr($request->getControllerName(), 0, 5) == 'admin' || $request->getModuleName() == 'admin')) {
				$request->setModuleName('admin');
				$request->setControllerName('login');
				$request->setActionName('index');
			} elseif (isset($components['user']['login']['index']) && !$auth->hasIdentity()) {
				$request->setModuleName('user');
				$request->setControllerName('login');
				$request->setActionName('index');
			} else {
				$request->setModuleName('default');
				$request->setControllerName('error');
				$request->setActionName('unauthorized');
			}
		}

		//ustawienie nawigatora
		if (null === ($navigation = Default_Registry::$cache->load('Mmi_Navigation_' . $request->__get('lang')))) {
			$navigation = new Mmi_Navigation(Cms_Model_Navigation_Dao::getNested());
			Default_Registry::$cache->save($navigation, 'Mmi_Navigation_' . $request->__get('lang'), 3600);
		}
		$navigation->setup($request);
		//przypinanie nawigatora do helpera widoku nawigacji
		Mmi_View_Helper_Navigation::setAcl($acl);
		Mmi_View_Helper_Navigation::setAuth($auth);
		Mmi_View_Helper_Navigation::setNavigation($navigation);
	}

}
