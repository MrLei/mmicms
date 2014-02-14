<?php

/**
 * MmiCms
 *
 * LICENSE
 *
 * Ten plik źródłowy objęty jest licencją BSD bez klauzuli ogłoszeniowej.
 * Licencja jest dostępna pod adresem: http://www.hqsoft.pl/new-bsd
 * W przypadku problemów, prosimy o kontakt na adres office@hqsoft.pl
 *
 * MmiCms/Application/Bootstrap.php
 * @category   MmiCms
 * @package    MmiCms_Application
 * @copyright  Copyright (c) 2010 HQSoft Mariusz Miłejko (http://www.hqsoft.pl)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    $Id$
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */

/**
 * Klasa startująca aplikację CMS
 * @category   MmiCms
 * @package    MmiCms_Application
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */
class MmiCms_Application_Bootstrap implements Mmi_Application_Bootstrap_Interface {

	/**
	 * Konstruktor, ustawia ścieżki, ładuje domyślne klasy, ustawia autoloadera
	 */
	public function __construct() {

		//ładowanie komponentów
		$this->_setupComponents();

		//inicjalizacja konfiguracji aplikacji
		$config = $this->_initConfiguration();

		//ustawienie cache
		$this->_setupCache($config);

		//inicjalizacja routera
		$router = $this->_initRouter($config, $config->application->languages[0]);

		//inicjalizacja tłumaczeń
		$translate = $this->_initTranslate($config->application->languages[0], $config->application->languages[0]);

		//inicjalizacja widoku
		$view = $this->_initView($config, $translate, $router);

		//ustawienie front controllera
		$this->_setupFrontController($config, $router, $view);

		//ustawienie bazy danych
		$this->_setupDatabase($config);
	}

	/**
	 * Uruchomienie bootstrapa skutkuje uruchomieniem front controllera
	 */
	public function run() {
		Mmi_Controller_Front::getInstance()->dispatch();
	}

	/**
	 * Ładowanie konfiguracji
	 * @return MmiCms_Config
	 * @throws Exception
	 */
	protected function _initConfiguration() {
		//lokalna konfiguracja
		try {
			$config = new Default_Config_Local();
		} catch (Exception $e) {
			throw new Exception('MmiCms_Application_Bootstrap requires application/modules/Default/Config/Local.php instance of MmiCms_Config');
		}
		//sprawdzenie czy zdefiniowano conajmniej jeden język
		if (!isset($config->application->languages[0])) {
			throw new Exception('No languages specified');
		}

		//konfiguracja profilera aplikacji
		Mmi_Profiler::setEnabled($config->application->debug);

		//ustawienie lokalizacji
		date_default_timezone_set($config->application->timeZone);
		ini_set('default_charset', $config->application->charset);
		return $config;
	}

	/**
	 * Ustawianie bufora
	 * @throws Exception
	 */
	protected function _setupCache(MmiCms_Config $config) {
		//dodawanie buforów do rejestru
		try {
			Default_Registry::$config = $config;
			Default_Registry::$cache = new Mmi_Cache($config->cache);
		} catch (Exception $e) {
			throw new Exception('MmiCms_Application_Bootstrap requires application/modules/Default/Registry.php instance of MmiCms_Registry');
		}
	}
	
	/**
	 * Inicjalizacja routera
	 * @param MmiCms_Config $config
	 * @param string $language
	 * @return Mmi_Controller_Router
	 */
	protected function _initRouter(MmiCms_Config $config, $language) {
		return new Mmi_Controller_Router($config->router, $language, $config->application->skin);
	}
	
	/**
	 * Inicjalizacja tłumaczeń
	 * @param string $defaultLanguage domyślny język
	 * @param string $language bieżący język
	 * @return Mmi_Translate
	 */
	protected function _initTranslate($defaultLanguage, $language) {
		$translate = new Mmi_Translate();
		$translate->setDefaultLocale($defaultLanguage);
		$translate->setLocale($language);
		return $translate;
	}

	/**
	 * Ustawianie bazy danych
	 * @param MmiCms_Config $config
	 */
	protected function _setupDatabase(MmiCms_Config $config) {
		//połączenie do bazy danych i konfiguracja DAO
		if (Default_Registry::$config->db->driver === null) {
			return;
		}
		Default_Registry::$config->db->profiler = $config->application->debug;
		Default_Registry::$db = Mmi_Db::factory(Default_Registry::$config->db);
		Mmi_Dao::setAdapter(Default_Registry::$db);
		Mmi_Dao::setCache(Default_Registry::$cache);
		Mmi_Profiler::event('Bootstrap: database setup');
	}

	/**
	 * Ustawianie front controllera
	 * @param Mmi_Controller_Router $router
	 * @param Mmi_View $view
	 */
	protected function _setupFrontController(MmiCms_Config $config, Mmi_Controller_Router $router, Mmi_View $view) {
		//wczytywanie struktury frontu z cache
		if (null === ($frontStructure = Default_Registry::$cache->load('Mmi_Structure'))) {
			$frontStructure = Mmi_Structure::getStructure();
			Default_Registry::$cache->save($frontStructure, 'Mmi_Structure', 86400);
		}
		//inicjalizacja frontu
		$frontController = Mmi_Controller_Front::getInstance();
		$frontController->setStructure($frontStructure)
			->setRouter($router)
			->setView($view);
		//rejestracja pluginów
		foreach ($config->application->plugins as $plugin) {
			$frontController->registerPlugin(new $plugin());
		}
	}

	/**
	 * Inicjalizacja widoku
	 * @param MmiCms_Config $config
	 * @param Mmi_Translate $translate
	 * @param Mmi_Controller_Router $router
	 * @return Mmi_View
	 */
	protected function _initView(MmiCms_Config $config, Mmi_Translate $translate, Mmi_Controller_Router $router) {
		//konfiguracja widoku
		$view = new Mmi_View();
		$view->setCache(Default_Registry::$cache)
			->setAlwaysCompile($config->application->compile)
			->setDebug($config->application->debug)
			->setTranslate($translate)
			->setBaseUrl($router->getBaseUrl());
		return $view;
	}

	/**
	 * Ładowanie komponentów statycznie, bez potrzeby użycia autoloadera
	 */
	protected function _setupComponents() {
		require LIB_PATH . '/Mmi/Cache/Config.php';
		require LIB_PATH . '/Mmi/Cache/Backend/Interface.php';
		require LIB_PATH . '/Mmi/Cache.php';
		require LIB_PATH . '/Mmi/Controller/Action/Helper/Messenger.php';
		require LIB_PATH . '/Mmi/Dao.php';
		require LIB_PATH . '/Mmi/Db.php';
		require LIB_PATH . '/Mmi/Db/Adapter/Pdo/Abstract.php';
		require LIB_PATH . '/Mmi/Db/Adapter/Pdo/Pgsql.php';
		require LIB_PATH . '/Mmi/Db/Config.php';
		require LIB_PATH . '/Mmi/Acl.php';
		require LIB_PATH . '/Mmi/Auth.php';
		require LIB_PATH . '/Mmi/Filter/Abstract.php';
		require LIB_PATH . '/Mmi/Filter/Urlencode.php';
		require LIB_PATH . '/Mmi/Http/Cookie.php';
		require LIB_PATH . '/Mmi/Navigation.php';
		require LIB_PATH . '/Mmi/Nested.php';
		require LIB_PATH . '/Mmi/Session/Config.php';
		require LIB_PATH . '/Mmi/Translate.php';
		require LIB_PATH . '/Mmi/View/Helper/Abstract.php';
		require LIB_PATH . '/Mmi/View/Helper/AbstractHead.php';
		require LIB_PATH . '/Mmi/View/Helper/HeadLink.php';
		require LIB_PATH . '/Mmi/View/Helper/HeadScript.php';
		require LIB_PATH . '/Mmi/View/Helper/Navigation.php';
		require LIB_PATH . '/Mmi/View/Helper/Messenger.php';
		require LIB_PATH . '/Mmi/View/Helper/Translate.php';
		require LIB_PATH . '/Mmi/View/Helper/Url.php';

		require LIB_PATH . '/MmiCms/Config.php';
		require LIB_PATH . '/MmiCms/Controller/Plugin.php';
		require LIB_PATH . '/MmiCms/Media/Config.php';
		require LIB_PATH . '/MmiCms/Registry.php';
	}

}
