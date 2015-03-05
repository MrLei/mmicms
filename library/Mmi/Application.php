<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
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
		//inicjalizacja aplikacji
		$this->_initPaths($path)
			->_initEncoding()
			->_initPhpConfiguration()
			->_initAutoloader()
			->_initErrorHandler();
		//tworzenie instancji bootstrapa
		$this->_bootstrap = new $bootstrapName($path);
		\Mmi\Profiler::event('Application: bootstrap executed');
		//bootstrap nie implementuje właściwego interfeace'u
		if (!($this->_bootstrap instanceof \Mmi\Application\BootstrapInterface)) {
			throw new \Exception('\Mmi\Application bootstrap should be implementing \Mmi\Application\Bootstrap\Interface');
		}
	}

	/**
	 * Uruchomienie aplikacji
	 * @param \Mmi\Bootstrap $bootstrap
	 */
	public function run() {
		$this->_bootstrap->run();
	}

	/**
	 * Ustawia kodowanie na UTF-8
	 * @return \Mmi\Application
	 */
	protected function _initEncoding() {
		//wewnętrzne kodowanie znaków
		mb_internal_encoding('utf-8');
		//domyślne kodowanie znaków PHP
		ini_set('default_charset', 'utf-8');
		//locale
		setlocale(LC_ALL, 'pl_PL.utf-8');
		setlocale(LC_NUMERIC, 'en_US.UTF-8');
		return $this;
	}

	/**
	 * Definicja ścieżek
	 * @param string $systemPath
	 * @return \Mmi\Application
	 */
	protected function _initPaths($systemPath) {
		$path = str_replace('\\', '/', $systemPath);
		//ścieżka projektu
		define('BASE_PATH', $path);
		//aplikacja
		define('APPLICATION_PATH', BASE_PATH . '/application');
		//biblioteki
		define('LIB_PATH', BASE_PATH . '/library');
		//ładowanie profilera
		require LIB_PATH . '/Mmi/Profiler.php';
		\Mmi\Profiler::event('Application: startup');
		//ścieżka do TMP
		define('TMP_PATH', BASE_PATH . '/tmp');
		//zasoby publiczne
		define('PUBLIC_PATH', BASE_PATH . '/public');
		//dane
		define('DATA_PATH', BASE_PATH . '/data');
		//domyślna ścieżka ładowania
		set_include_path(LIB_PATH);
		return $this;
	}

	/**
	 * Inicjalizacja konfiguracji PHP
	 * @return \Mmi\Application
	 */
	protected function _initPhpConfiguration() {
		//obsługa włączonych magic quotes
		if (ini_get('magic_quotes_gpc')) {
			throw new \Exception('\Mmi\Application: magic quotes enabled');
		}
		return $this;
	}

	/**
	 * Inicjuje autoloader
	 * @return \Mmi\Application
	 */
	protected function _initAutoloader() {
		//rejestrowanie autoloadera
		spl_autoload_register(function ($class) {
			//rozbicie po \
			$name = explode('\\', $class);
			$namespace = $name[0];
			switch ($namespace) {
				//dla mmi ładujemy z LIB_PATH
				case ((substr($namespace, 0, 3) == 'Mmi') ? $namespace : !$namespace):
					$path = LIB_PATH . '/' . $namespace;
					array_shift($name);
					break;
				//pozostałe z modułów
				default:
					$path = APPLICATION_PATH . '/modules';
			}
			//dołączenie pliku
			include $path . '/' . implode('/', $name) . '.php';
		});
		return $this;
	}

	/**
	 * Ustawia handler błędów
	 * @return \Mmi\Application
	 */
	protected function _initErrorHandler() {
		//domyślne przechwycenie wyjątków
		set_exception_handler(array('\Mmi\Application\Error', 'exceptionHandler'));
		//domyślne przechwycenie błędów
		set_error_handler(array('\Mmi\Application\Error', 'errorHandler'));
		return $this;
	}

}
