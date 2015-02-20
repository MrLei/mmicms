<?php

/**
 * MmiCMS
 */

/**
 * Wtyczka FC
 */

namespace MmiCms\Controller;

class Plugin extends \Mmi\Controller\Plugin\PluginAbstract {

	public function routeStartup(\Mmi\Controller\Request $request) {
		//route z cms
		if (null === ($routes = Core\Registry::$cache->load('Mmi-Route'))) {
			$routes = Cms\Model\Route\Dao::activeQuery()->find();
			Core\Registry::$cache->save($routes, 'Mmi-Route', 86400);
		}
		Cms\Model\Route\Dao::updateRouterConfig(\Mmi\Controller\Front::getInstance()->getRouter()->getConfig(), $routes);
	}

	public function preDispatch(\Mmi\Controller\Request $request) {
		//niepoprawny język
		if ($request->__get('lang') && !in_array($request->__get('lang'), Core\Registry::$config->application->languages)) {
			\Mmi\Controller\Front::getInstance()->getResponse()->setCodeNotFound();
			unset($request->lang);
			if (isset(Core\Registry::$config->application->languages[0])) {
				$request->lang = Core\Registry::$config->application->languages[0];
			}
			$request->setModuleName('default');
			$request->setControllerName('error');
			$request->setActionName('index');
		}
		//brak komponentu (moduł + kontroler + akcja)
		$components = \Mmi\Controller\Front::getInstance()->getStructure('module');
		if (!isset($components[$request->getModuleName()][$request->getControllerName()][$request->getActionName()])) {
			\Mmi\Controller\Front::getInstance()->getResponse()->setCodeNotFound();
			$request->setModuleName('default');
			$request->setControllerName('error');
			$request->setActionName('index');
		}

		//ustawianie sesji
		if (Core\Registry::$config->session->name) {
			require LIB_PATH . '/Mmi/Session.php';
			require LIB_PATH . '/Mmi/Session/Namespace.php';
			\Mmi\Session::start(Core\Registry::$config->session);
		}

		//ustawienie widoku
		$view = \Mmi\Controller\Front::getInstance()->getView();
		$base = $view->baseUrl;
		$view->domain = Core\Registry::$config->application->host;
		$view->mediaServer = Core\Registry::$config->media->server;
		$view->languages = Core\Registry::$config->application->languages;

		$jsReqestArray = array();
		$jsReqestArray[] = "'baseUrl' : '" . $base . "'";
		$filter = new \Mmi\Filter\Urlencode();
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
		$auth = new \Mmi\Auth();
		$auth->setSalt(Core\Registry::$config->application->salt);
		$auth->setModelName(Core\Registry::$config->session->authModel ? Core\Registry::$config->session->authModel : 'Cms\Model\Auth');
		Core\Registry::$auth = $auth;

		$cookie = new \Mmi\Http\Cookie();
		$remember = Core\Registry::$config->session->authRemember ? Core\Registry::$config->session->authRemember : 0;
		if ($remember > 0 && !$auth->hasIdentity() && $cookie->match('remember')) {
			$params = array();
			parse_str($cookie->getValue(), $params);
			if (isset($params['id']) && isset($params['key']) && $params['key'] == md5(Core\Registry::$config->application->salt . $params['id'])) {
				$auth->setIdentity($params['id']);
				$auth->idAuthenticate();
			}
		}
		if ($auth->hasIdentity()) {
			$view->auth = $auth;
		}

		//ustawienie acl
		if (null === ($acl = Core\Registry::$cache->load('Mmi-Acl'))) {
			\Mmi\Profiler::event('Init Acl');
			$acl = Cms\Model\Acl\Dao::setupAcl();
			Core\Registry::$cache->save($acl, 'Mmi-Acl', 86400);
		}

		\Mmi\Controller\Action\Helper\Action::setAcl($acl);
		\Mmi\Controller\Action\Helper\Action::setAuth($auth);
		Core\Registry::$acl = $acl;
		$view->acl = $acl;

		//zablokowane na ACL
		if (!$acl->isAllowed($auth->getRoles(), strtolower($request->getModuleName() . ':' . $request->getControllerName() . ':' . $request->getActionName()))) {
			if (!$auth->hasIdentity() && substr($request->getControllerName(), 0, 5) == 'admin') {
				$request->setModuleName('cms');
				$request->setControllerName('admin');
				$request->setActionName('login');
			} elseif (isset($components['cms']['user']['login']) && !$auth->hasIdentity()) {
				$request->setModuleName('cms');
				$request->setControllerName('user');
				$request->setActionName('login');
			} else {
				$request->setModuleName('default');
				$request->setControllerName('error');
				$request->setActionName('unauthorized');
				\Mmi\Controller\Front::getInstance()->getResponse()->setCodeForbidden();
			}
		}

		//ustawienie nawigatora
		if (null === ($navigation = \Core\Registry::$cache->load('Mmi-Navigation-' . $request->__get('lang')))) {
			$config = Core\Registry::$config->navigation;
			Cms\Model\Navigation\Dao::decorateConfiguration($config);
			$navigation = new \Mmi\Navigation($config);
			Core\Registry::$cache->save($navigation, 'Mmi-Navigation-' . $request->__get('lang'), 3600);
		}
		$navigation->setup($request);
		//przypinanie nawigatora do helpera widoku nawigacji
		\Mmi\View\Helper\Navigation::setAcl($acl);
		\Mmi\View\Helper\Navigation::setAuth($auth);
		\Mmi\View\Helper\Navigation::setNavigation($navigation);
	}

	public function postDispatch(\Mmi\Controller\Request $request) {
		if (!Core\Registry::issetVar('adminPage')) {
			return;
		}
		$request->module = 'cms';
		$request->controller = 'admin';
	}

}
