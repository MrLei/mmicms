<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace MmiCms\Application;

class Bootstrap implements \Mmi\Application\BootstrapInterface {

	/**
	 * Konstruktor, ustawia ścieżki, ładuje domyślne klasy, ustawia autoloadera
	 */
	public function __construct() {
		//inicjalizacja konfiguracji aplikacji
		$config = $this->_initConfiguration();

		//ustawienie cache
		$this->_setupCache($config);

		//inicjalizacja tłumaczeń
		$translate = $this->_initTranslate($config);

		//inicjalizacja routera
		$router = $this->_initRouter($config, $translate->getLocale());

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
		\Mmi\Controller\Front::getInstance()->dispatch();
	}

	/**
	 * Ładowanie konfiguracji
	 * @return MmiCms\Config
	 * @throws Exception
	 */
	protected function _initConfiguration() {
		//lokalna konfiguracja
		$config = new \Core\Config\Local();

		//konfiguracja profilera aplikacji
		\Mmi\Profiler::setEnabled($config->application->debug);

		//ustawienie lokalizacji
		date_default_timezone_set($config->application->timeZone);
		ini_set('default_charset', $config->application->charset);
		return $config;
	}

	/**
	 * Ustawianie bufora
	 * @throws Exception
	 */
	protected function _setupCache(\MmiCms\Config $config) {
		//dodawanie buforów do rejestru
		try {
			\Core\Registry::$config = $config;
			\Core\Registry::$cache = new \Mmi\Cache($config->cache);
		} catch (Exception $e) {
			throw new\Exception('MmiCms\Application\Bootstrap: Unable to invoke Cache');
		}
	}

	/**
	 * Inicjalizacja routera
	 * @param \MmiCms\Config $config
	 * @param string $language
	 * @return \Mmi\Controller\Router
	 */
	protected function _initRouter(\MmiCms\Config $config, $language) {
		return new \Mmi\Controller\Router($config->router, $language, $config->application->skin);
	}

	/**
	 * Inicjalizacja tłumaczeń
	 * @param \MmiCms\Config $config
	 * @return \Mmi\Translate
	 */
	protected function _initTranslate(\MmiCms\Config $config) {
		$defaultLanguage = isset($config->application->languages[0]) ? $config->application->languages[0] : null;
		$translate = new \Mmi\Translate();
		$translate->setDefaultLocale($defaultLanguage);
		$envLang = \Mmi\Controller\Front::getInstance()->getEnvironment()->applicationLanguage;
		if (null === $envLang) {
			return $translate;
		}
		if (!in_array($envLang, $config->application->languages)) {
			return $translate;
		}
		$translate->setLocale($envLang);
		return $translate;
	}

	/**
	 * Ustawianie bazy danych
	 * @param \MmiCms\Config $config
	 */
	protected function _setupDatabase(\MmiCms\Config $config) {
		//połączenie do bazy danych i konfiguracja DAO
		if (\Core\Registry::$config->db->driver === null) {
			return;
		}
		\Core\Registry::$config->db->profiler = $config->application->debug;
		\Core\Registry::$db = \Mmi\Db::factory(\Core\Registry::$config->db);
		\Mmi\Dao::setAdapter(\Core\Registry::$db);
		\Mmi\Dao::setCache(\Core\Registry::$cache);
	}

	/**
	 * Ustawianie front controllera
	 * @param \MmiCms\Config $config
	 * @param \Mmi\Controller\Router $router
	 * @param \Mmi\View $view
	 */
	protected function _setupFrontController(\MmiCms\Config $config, \Mmi\Controller\Router $router, \Mmi\View $view) {
		//wczytywanie struktury frontu z cache
		if (null === ($frontStructure = \Core\Registry::$cache->load('Mmi-Structure'))) {
			$frontStructure = \Mmi\Structure::getStructure();
			\Core\Registry::$cache->save($frontStructure, 'Mmi-Structure', 86400);
		}
		//inicjalizacja frontu
		$frontController = \Mmi\Controller\Front::getInstance();
		$frontController->setStructure($frontStructure)
			->setRouter($router)
			->setView($view)
			->getResponse()->setDebug($config->application->debug);
		//rejestracja pluginów
		foreach ($config->application->plugins as $plugin) {
			$frontController->registerPlugin(new $plugin());
		}
	}

	/**
	 * Inicjalizacja widoku
	 * @param \MmiCms\Config $config
	 * @param \Mmi\Translate $translate
	 * @param \Mmi\Controller\Router $router
	 * @return \Mmi\View
	 */
	protected function _initView(\MmiCms\Config $config, \Mmi\Translate $translate, \Mmi\Controller\Router $router) {
		//konfiguracja widoku
		$view = new \Mmi\View();
		$view->setCache(\Core\Registry::$cache)
			->setAlwaysCompile($config->application->compile)
			->setTranslate($translate)
			->setBaseUrl($router->getBaseUrl());
		return $view;
	}

}
