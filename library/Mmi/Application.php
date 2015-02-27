<?php

/**
 * Mmi
 *
 * LICENSE
 *
 * Ten plik źródłowy objęty jest licencją BSD bez klauzuli ogłoszeniowej.
 * Licencja jest dostępna pod adresem: http://milejko.com/new-bsd.txt
 * W przypadku problemów, prosimy o kontakt na adres mariusz@milejko.pl
 *
 * Mmi/Application.php
 * @category   Mmi
 * @package    \Mmi\Application
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    1.0.0
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */
/**
 * Bazowa startująca aplikacji, ustawia ścieżki, ładuje ogólną konfigurację
 * @category   Mmi
 * @package    \Mmi\Application
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

namespace Mmi;

class Application {

	/**
	 * Obiekt bootstrap
	 * @var \Mmi\Bootstrap
	 */
	private $_bootstrap;

	/**
	 * Konstruktor
	 * @param string $path
	 */
	public function __construct($path, $bootstrapName = '\Mmi\Application\Bootstrap') {
		$this->_initPaths($path)
			->_initDefaultComponents()
			->_initEncoding()
			->_initPhpConfiguration()
			->_initAutoloader()
			->_initErrorHandler();
		\Mmi\Profiler::event('Init bootstrap');
		$this->_bootstrap = new $bootstrapName($path);
		if (!($this->_bootstrap instanceof \Mmi\Application\BootstrapInterface)) {
			throw new\Exception('\Mmi\Application bootstrap should be implementing \Mmi\Application\Bootstrap\Interface');
		}
	}

	/**
	 * Uruchomienie aplikacji
	 * @param \Mmi\Bootstrap $bootstrap
	 */
	public function run() {
		\Mmi\Profiler::event('Bootstrap run');
		$this->_bootstrap->run();
	}

	/**
	 * Ustawia kodowanie na UTF-8
	 * @return \Mmi\Application
	 */
	protected function _initEncoding() {
		mb_internal_encoding('utf-8');
		ini_set('default_charset', 'utf-8');
		setlocale(LC_ALL, 'pl_PL.utf-8');
		setlocale(LC_NUMERIC, 'en_US.UTF-8');
		return $this;
	}

	/**
	 * Definicja ścieżek
	 * @return \Mmi\Application
	 */
	protected function _initPaths($path) {
		$path = str_replace('\\', '/', $path);
		define('BASE_PATH', $path);
		define('APPLICATION_PATH', BASE_PATH . '/application');
		define('LIB_PATH', BASE_PATH . '/library');
		define('TMP_PATH', BASE_PATH . '/tmp');
		define('PUBLIC_PATH', BASE_PATH . '/public');
		define('DATA_PATH', BASE_PATH . '/data');
		set_include_path(LIB_PATH);
		return $this;
	}

	/**
	 * Ładowanie domyślnych komponentów
	 * @return \Mmi\Application
	 */
	protected function _initDefaultComponents() {
		require LIB_PATH . '/Mmi/Profiler.php';
		Profiler::event('Application init');
		require LIB_PATH . '/Mmi/Application/BootstrapInterface.php';
		require LIB_PATH . '/Mmi/Application/Config.php';
		require LIB_PATH . '/Mmi/Application/Error.php';
		require LIB_PATH . '/Mmi/Config.php';
		require LIB_PATH . '/Mmi/Controller/Action/Helper/HelperAbstract.php';
		require LIB_PATH . '/Mmi/Controller/Action/Helper/Action.php';
		require LIB_PATH . '/Mmi/Controller/Action/HelperBroker.php';
		require LIB_PATH . '/Mmi/Controller/Plugin/PluginAbstract.php';
		require LIB_PATH . '/Mmi/Controller/Action.php';
		require LIB_PATH . '/Mmi/Controller/Environment.php';
		require LIB_PATH . '/Mmi/Controller/Front.php';
		require LIB_PATH . '/Mmi/Controller/Request.php';
		require LIB_PATH . '/Mmi/Controller/Response.php';
		require LIB_PATH . '/Mmi/Controller/Router/Config.php';
		require LIB_PATH . '/Mmi/Controller/Router/Config/Route.php';
		require LIB_PATH . '/Mmi/Controller/Router.php';
		require LIB_PATH . '/Mmi/Exception/Logger.php';
		require LIB_PATH . '/Mmi/Registry.php';
		require LIB_PATH . '/Mmi/View.php';
		return $this;
	}

	/**
	 * Inicjalizacja konfiguracji PHP
	 * @return \Mmi\Application
	 */
	protected function _initPhpConfiguration() {
		//obsługa włączonych magic quotes
		if (!ini_get('magic_quotes_gpc')) {
			return $this;
		}

		function _stripslashesGpc(&$value) {
			$value = stripslashes($value);
		}

		array_walk_recursive($_GET, array('_stripslashesGpc'));
		array_walk_recursive($_POST, array('_stripslashesGpc'));
		array_walk_recursive($_COOKIE, array('_stripslashesGpc'));
		array_walk_recursive($_REQUEST, array('_stripslashesGpc'));
		return $this;
	}

	/**
	 * Inicjuje autoloader
	 * @return \Mmi\Application
	 */
	protected function _initAutoloader() {
		spl_autoload_register(function ($class) {
			if (strpos($class, 'PHPUnit') !== false) {
				return;
			}
			$name = explode('\\', $class);
			if (!isset($name[0])) {
				return;
			}
			$namespace = $name[0];
			switch ($namespace) {
				case ((substr($namespace, 0, 3) == 'Mmi') ? $namespace : !$namespace):
				case 'Zend':
					$path = LIB_PATH . '/' . $namespace;
					array_shift($name);
					break;
				default:
					$path = APPLICATION_PATH . '/modules';
			}
			\Mmi\Profiler::event('Autoloaded: ' . $class);
			include $path . '/' . implode('/', $name) . '.php';
		});
		return $this;
	}

	/**
	 * Ustawia handler błędów
	 * @return \Mmi\Application
	 */
	protected function _initErrorHandler() {
		set_exception_handler(array('\Mmi\Application\Error', 'exceptionHandler'));
		set_error_handler(array('\Mmi\Application\Error', 'errorHandler'));
		return $this;
	}

}
