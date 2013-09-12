<?php

/**
 * Mmi
 *
 * LICENSE
 *
 * Ten plik źródłowy objęty jest licencją BSD bez klauzuli ogłoszeniowej.
 * Licencja jest dostępna pod adresem: http://www.hqsoft.pl/new-bsd
 * W przypadku problemów, prosimy o kontakt na adres office@hqsoft.pl
 *
 * Mmi/Bootstrap/Cmd.php
 * @category   Mmi
 * @package    Mmi_Bootstrap
 * @copyright  Copyright (c) 2010 HQSoft Mariusz Miłejko (http://www.hqsoft.pl)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    $Id$
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */

/**
 * Klasa startu aplikacji command line
 * ustawia ścieżki, ładuje ogólną konfigurację
 * @category   Mmi
 * @package    Mmi_Bootstrap
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */
class Mmi_Bootstrap_Cmd extends Mmi_Bootstrap {

	/**
	 * Konstruktor, ustawia ścieżki, ładuje domyślne klasy, ustawia autoloadera
	 * @param string $path ścieżka
	 */
	public function __construct($path) {
		//ustawienie kodowań
		mb_internal_encoding('UTF-8');
		setlocale(LC_ALL, 'en_US.utf-8');

		//ustawianie ścieżek
		define('BASE_PATH', $path);
		define('APPLICATION_PATH', BASE_PATH . '/application');
		define('LIB_PATH', BASE_PATH . '/library');
		define('TMP_PATH', BASE_PATH . '/tmp');
		define('PUBLIC_PATH', BASE_PATH . '/public');
		define('DATA_PATH', BASE_PATH . '/data');

		//ustawianie PHP
		set_include_path(LIB_PATH);

		//ładowanie domyślnych komponentów
		require LIB_PATH . '/Mmi/Config.php';
		require LIB_PATH . '/Mmi/Profiler.php';

		//wczytanie konfiguracji
		$_ = array();
		require APPLICATION_PATH . '/configs/application.php';
		require APPLICATION_PATH . '/configs/routes.php';
		require APPLICATION_PATH . '/configs/local.php';
		Mmi_Config::setConfig($_);
		Mmi_Profiler::event('Configuration loaded');

		//ustawianie hosta (jeśli brak - predefiniowany w configu)
		define('HOST', isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : Mmi_Config::get('global', 'host'));

		//wyłączenie cache
		Mmi_Config::$data['cache']['active'] = false;

		//konfiguracja php
		if (isset($_['global']['php'])) {
			foreach ($_['global']['php'] as $key => $value) {
				ini_set($key, $value);
			}
		}

		//obsługa włączonych magic quotes
		if (ini_get('magic_quotes_gpc')) {
			array_walk_recursive($_GET, array($this, '_stripslashesGpc'));
			array_walk_recursive($_POST, array($this, '_stripslashesGpc'));
			array_walk_recursive($_COOKIE, array($this, '_stripslashesGpc'));
			array_walk_recursive($_REQUEST, array($this, '_stripslashesGpc'));
		}

		//ustawienie lokalizacji
		date_default_timezone_set(Mmi_Config::$data['global']['timeZone']);

		//rejestrowanie autoloadera
		spl_autoload_register(array($this, 'loader'));

		//obsługa wyjątków i błędów
		set_exception_handler(array($this, 'exceptionHandler'));
		set_error_handler(array($this, 'errorHandler'));
	}

	/**
	 * Obsługuje wyjątki
	 * @param Exception $exception wyjątek
	 * @return boolean
	 */
	public function exceptionHandler(Exception $exception) {
		@ob_clean();
		$position = $this->logException($exception);
		echo $exception->getMessage() . "\n\n";
		echo $position['info'] . "\n";
		return true;
	}

	/**
	 * Uruchamianie front-kontrolera (brak front kontrolera)
	 */
	public function run() {
		ob_start();
		$front = $this->registerPlugins();
		$params = array('lang' => ((isset(Mmi_Config::$data['global']['languages'][0])) ? Mmi_Config::$data['global']['languages'][0] : null),
			'skin' => ((isset(Mmi_Config::$data['global']['skin'])) ? Mmi_Config::$data['global']['skin'] : 'default'),
			'module' => 'default');
		$front->setRequest(new Mmi_Controller_Request($params));
		$front->setResponse(new Mmi_Controller_Response());
		$front->routeStartup();
		$front->preDispatch();
		$front->postDispatch();
	}

}