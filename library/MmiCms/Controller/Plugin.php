<?php

/**
 * MmiCMS
 */

/**
 * Wtyczka FC
 */
class MmiCms_Controller_Plugin extends Mmi_Controller_Plugin_Abstract {

	public function routeStartup(Mmi_Controller_Request $request) {

		ini_set('default_charset', Mmi_Config::$data['global']['charset']);
		ini_set('include_path', LIB_PATH);

		//statyczne ładowanie obowiązkowych plików
		require LIB_PATH . '/Mmi/Controller/Action/Helper/Messenger.php';
		require LIB_PATH . '/Mmi/Db.php';
		require LIB_PATH . '/Mmi/Db/Adapter/Pdo/Abstract.php';
		require LIB_PATH . '/Mmi/Db/Adapter/Pdo/Pgsql.php';
		require LIB_PATH . '/Mmi/Http/Cookie.php';
		require LIB_PATH . '/Mmi/View/Helper/Abstract.php';
		require LIB_PATH . '/Mmi/View/Helper/HeadLink.php';
		require LIB_PATH . '/Mmi/View/Helper/HeadScript.php';
		require LIB_PATH . '/Mmi/View/Helper/Navigation.php';
		require LIB_PATH . '/Mmi/View/Helper/Messenger.php';
		require LIB_PATH . '/Mmi/View/Helper/Url.php';
		require LIB_PATH . '/Mmi/Acl.php';
		require LIB_PATH . '/Mmi/Auth.php';
		require LIB_PATH . '/Mmi/Navigation.php';
		require LIB_PATH . '/Mmi/Nested.php';
		require LIB_PATH . '/Mmi/Registry.php';
		require LIB_PATH . '/Mmi/Translate.php';

		$cacheActive = Mmi_Config::$data['cache']['active'];
		$cache = Mmi_Cache::getInstance();

		//database connection
		if (Mmi_Config::$data['global']['debug']) {
			Mmi_Config::$data['db']['profiler'] = true;
		}
		if (isset(Mmi_Config::$data['encryptDb'])) {
			$db = unserialize(Mmi_Lib::decrypt(Mmi_Config::$data['encryptDb'], 'print_r'));
		} else {
			$db = Mmi_Config::$data['db'];
		}
		Mmi_Registry::set('Mmi_Db', Mmi_Db::factory($db));

		//route z cms
		if (!$cacheActive || null === ($routes = $cache->load('Mmi_Route'))) {
			$routes = Cms_Model_Route_Dao::findActive();
			if ($cacheActive) {
				$cache->save($routes, 'Mmi_Route', 86400);
			}
		}
		Mmi_Controller_Router::getInstance()->setRoutes(array_merge(Mmi_Config::$data['routes'], $routes));
	}

	public function preDispatch(Mmi_Controller_Request $request) {

		$cacheActive = Mmi_Config::$data['cache']['active'];
		$cache = Mmi_Cache::getInstance();

		//niepoprawny język
		if (!in_array($request->__get('lang'), Mmi_Config::$data['global']['languages'])) {
			Mmi_Controller_Front::getInstance()->getResponse()->setCode(404);
			$request->__set('module', 'default');
			$request->__set('controller', 'error');
			$request->__set('action', 'index');
		}

		//brak komponentu (moduł + kontroler + akcja)
		$components = Mmi_Controller_Front::getInstance()->getStructure('module');
		if (!isset($components[$request->__get('module')][$request->__get('controller')][$request->__get('action')])) {
			Mmi_Controller_Front::getInstance()->getResponse()->setCode(404);
			$request->__set('module', 'default');
			$request->__set('controller', 'error');
			$request->__set('action', 'index');
		}

		if (isset(Mmi_Config::$data['session'])) {
			require LIB_PATH . '/Mmi/Session.php';
			require LIB_PATH . '/Mmi/Session/Namespace.php';
			if (isset($_REQUEST['_sessionId']) && $_REQUEST['_sessionId']) {
				Mmi_Session::setId($_REQUEST['_sessionId']);
			}
			Mmi_Session::start(Mmi_Config::$data['session']);
		}

		$lang = $request->getParam('lang');
		$module = $request->getModuleName();
		$skin = $request->getParam('skin');
		$view = Mmi_View::getInstance();
		$base = $request->getBaseUrl();
		$view->domain = HOST;
		$view->baseUrl = $base;
		$view->baseModule = $request->getParam('baseModule');
		$view->baseSkin = $request->getParam('baseSkin');
		
		$jsReqestArray = array();
		$jsReqestArray[] = "'baseUrl' : '".$base."'";
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
			$jsReqestArray[] = "'".$filter->filter($param)."' : ".$value;
		}
		$jsRequest = "var request = {\n".implode(",\n", $jsReqestArray)."\n};";
		$view->headScript()->appendScript($jsRequest);
		
		$auth = Mmi_Auth::getInstance();
		$auth->setModelName(isset(Mmi_Config::$data['session']['model']) ? Mmi_Config::$data['session']['model'] : 'Cms_Model_Auth');
		$cookie = new Mmi_Http_Cookie();
		$remember = isset(Mmi_Config::$data['session']['remember_me_seconds']) ? Mmi_Config::$data['session']['remember_me_seconds'] : 0;
		if ($remember > 0 && !$auth->hasIdentity() && $cookie->match('remember')) {
			$params = array();
			parse_str($cookie->getValue(), $params);
			if (isset($params['id']) && isset($params['key']) && $params['key'] == md5(Mmi_Config::get('global', 'salt') . $params['id'])) {
				$auth->setIdentity($params['id']);
				$auth->idAuthenticate();
			}
		}
		if ($auth->hasIdentity()) {
			$view->auth = $auth;
		}

		//acl
		if (!$cacheActive || !($acl = $cache->load('Mmi_Acl'))) {
			Mmi_Profiler::event('Init Acl');
			$acl = Cms_Model_Acl_Dao::setupAcl();
			if ($cacheActive) {
				$cache->save($acl, 'Mmi_Acl', 86400);
			}
		}
		Mmi_Registry::set('Mmi_Acl', $acl);

		if (!$acl->isAllowed(Mmi_Auth::getInstance()->getRoles(), strtolower($request->getModuleName() . ':' . $request->getControllerName() . ':' . $request->getActionName()))) {
			if ($auth->hasIdentity()) {
				$request->setModuleName('default');
				$request->setControllerName('error');
				$request->setActionName('unauthorized');
			} else {
				$module = $request->getModuleName();
				$module = ($module == 'admin') ? 'admin' : 'user';
				if (substr($request->getControllerName(), 0, 5) == 'admin') {
					$module = 'admin';
				}
				$request->setModuleName($module);
				$request->setControllerName('login');
				$request->setActionName('index');
			}
		}
		Mmi_Profiler::event('Init plugin');
		if (!$cacheActive || !($navigation = $cache->load('Mmi_Navigation_' . $request->__get('lang')))) {
			$navigation = new Mmi_Navigation(Cms_Model_Navigation_Dao::getNested());
			if ($cacheActive) {
				$cache->save($navigation, 'Mmi_Navigation_' . $request->__get('lang'), 86400);
			}
		}
		$view->mediaServer = '';
		if (isset(Mmi_Config::$data['cms']['mediaServer'])) {
			$view->mediaServer = Mmi_Config::$data['cms']['mediaServer'];
		}
		$navigation->setup($request);
		Mmi_Registry::set('Mmi_Navigation', $navigation);
		Mmi_Profiler::event('Init Navigation');
	}

}