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

		//dodawanie buforów do rejestru
		try {
			Default_Registry::$config = $config;
			Default_Registry::$cache = new Mmi_Cache($config->cache);
		} catch (Exception $e) {
			throw new Exception('MmiCms_Application_Bootstrap requires application/modules/Default/Registry.php instance of MmiCms_Registry');
		}

		//wczytywanie struktury frontu z cache
		if (null === ($frontStructure = Default_Registry::$cache->load('Mmi_Structure'))) {
			$frontStructure = Mmi_Structure::getStructure();
			Default_Registry::$cache->save($frontStructure, 'Mmi_Structure', 86400);
		}

		//inicjalizacja frontu
		$front = Mmi_Controller_Front::getInstance();
		$front->setStructure($frontStructure);

		//ładowanie pluginów frontu
		foreach ($config->application->plugins as $plugin) {
			$front->registerPlugin(new $plugin());
		}

		//ustawianie rout
		$router = new Mmi_Controller_Router($config->router, $config->application->languages[0], $config->application->skin);
		//przypinanie routera do helpera redirectora
		Mmi_Controller_Action_Helper_Redirector::setRouter($router);
		Mmi_View_Helper_Url::setRouter($router);
		$front->setRouter($router);

		//tłumaczenia
		$translate = new Mmi_Translate();
		$translate->setDefaultLocale($config->application->languages[0]);
		$translate->setLocale($config->application->languages[0]);
		//przypinanie translatora do helpera widoku
		Mmi_View_Helper_Translate::setTranslate($translate);

		//konfiguracja widoku
		$view = Mmi_View::getInstance();
		$view->setCache(Default_Registry::$cache);
		$view->setAlwaysCompile($config->application->compile);
		$view->setDebug($config->application->debug);
		$view->setTranslate($translate);
		$view->setBaseUrl($router->getBaseUrl());

		//połączenie do bazy danych
		if (Default_Registry::$config->db->driver !== null) {
			Default_Registry::$config->db->profiler = $config->application->debug;
			Default_Registry::$db = Mmi_Db::factory(Default_Registry::$config->db);
			Mmi_Dao::setAdapter(Default_Registry::$db);
			Mmi_Dao::setCache(Default_Registry::$cache);
			Mmi_Profiler::event('Bootstrap setup done');
		}
	}

	/**
	 * Uruchomienie bootstrapa skutkuje uruchomieniem front kontrolera
	 */
	public function run() {
		Mmi_Controller_Front::getInstance()->dispatch();
	}

}
