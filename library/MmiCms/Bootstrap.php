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
 * MmiCms/Bootstrap.php
 * @category   MmiCms
 * @package    MmiCms_Bootstrap
 * @copyright  Copyright (c) 2010 HQSoft Mariusz Miłejko (http://www.hqsoft.pl)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    $Id$
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */

/**
 * Klasa startująca aplikację CMS
 * @category   MmiCms
 * @package    MmiCms_Bootstrap
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */
abstract class MmiCms_Bootstrap extends Mmi_Bootstrap {

	/**
	 * Konstruktor, ustawia ścieżki, ładuje domyślne klasy, ustawia autoloadera
	 * @param string $path ścieżka
	 */
	public function __construct($path) {

		parent::__construct($path);

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
		require LIB_PATH . '/Mmi/Translate.php';

		//lokalna konfiguracja
		$config = new Default_Config_Local();

		//ustawienie lokalizacji
		date_default_timezone_set($config->application->timeZone);

		//dodawanie buforów do rejestru
		Default_Registry::$config = $config;
		Default_Registry::$cache = new Mmi_Cache($config->cache);

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

		if (!isset($config->application->languages[0])) {
			throw new Exception('No languages specified');
		}

		//ustawianie rout
		$router = Mmi_Controller_Router::getInstance();
		$router->setConfig($config->router);
		$router->setDefaultLanguage($config->application->languages[0]);
		$router->setDefaultSkin($config->application->skin);

		//tłumaczenia
		$translate = new Mmi_Translate();
		$translate->setDefaultLocale($config->application->languages[0]);
		$translate->setLocale($config->application->languages[0]);
		Default_Registry::$translate = $translate;
		
		$view = Mmi_View::getInstance();
		$view->setTranslate(Default_Registry::$translate);
	}

}
