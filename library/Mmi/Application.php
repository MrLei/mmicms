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
 * Mmi/Application.php
 * @category   Mmi
 * @package    Mmi_Application
 * @copyright  Copyright (c) 2010 HQSoft Mariusz Miłejko (http://www.hqsoft.pl)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    $Id$
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */

/**
 * Bazowa startująca aplikacji, ustawia ścieżki, ładuje ogólną konfigurację
 * @category   Mmi
 * @package    Mmi_Application
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */
class Mmi_Application {

	/**
	 * Klasa bootstrapa aplikacji
	 * @var Mmi_Bootstrap
	 */
	private $_bootstrap;

	/**
	 * Konstruktor
	 * @param string $path
	 */
	public function __construct($path, $bootstrapName = 'Mmi_Application_Bootstrap') {
		ob_start();
		$this->_initPaths($path)
				->_initDefaultComponents()
				->_initEncoding()
				->_initPhpConfiguration()
				->_initAutoloader()
				->_initErrorHandler();
		Mmi_Profiler::event('Init bootstrap');
		$this->_bootstrap = new $bootstrapName($path);
		if (!($this->_bootstrap instanceof Mmi_Application_Bootstrap_Interface)) {
			throw new Exception('Mmi_Application bootstrap should be implementing Mmi_Application_Bootstrap_Interface');
		}
	}

	/**
	 * Uruchomienie aplikacji
	 * @param Mmi_Bootstrap $bootstrap
	 */
	public function run() {
		Mmi_Profiler::event('Bootstrap run');
		$this->_bootstrap->run();
	}

	/**
	 * Autoloader klas
	 * @param string $class nazwa klasy
	 * @return null
	 */
	public function loader($class) {
		$name = explode('_', $class);
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
		Mmi_Profiler::event('Autoloaded: ' . $class);
		include $path . '/' . implode('/', $name) . '.php';
	}

	/**
	 * Obsługuje błędy, ostrzeżenia
	 * @param string $errno numer błędu
	 * @param string $errstr treść błędu
	 * @param string $errfile plik
	 * @param string $errline linia z błędem
	 * @param string $errcontext kontekst
	 * @return boolean
	 */
	public function errorHandler($errno, $errstr, $errfile, $errline, $errcontext) {
		if (error_reporting() > 0) {
			switch ($errno) {
				case 2:
					$code = 'WARNING';
					break;
				case 4:
					$code = 'PARSE';
					break;
				case 8:
					$code = 'NOTICE';
					break;
				case 2048:
					$code = 'STRICT';
					break;
				default:
					$code = 'OTHER';
			}
			if (!is_writable(TMP_PATH . '/compile')) {
				mkdir(TMP_PATH . '/compile', 0777, true);
			}
			if (!is_writable(TMP_PATH . '/cache')) {
				mkdir(TMP_PATH . '/cache', 0777, true);
			}
			if (!is_writable(TMP_PATH . '/session')) {
				mkdir(TMP_PATH . '/session', 0777, true);
			}
			if (!is_writable(TMP_PATH . '/log')) {
				mkdir(TMP_PATH . '/log', 0777, true);
			}
			throw new Exception($code . ': ' . $errstr . '[' . $errfile . ' (' . $errline . ')]');
		}
		return true;
	}

	/**
	 * Obsługuje wyjątki
	 * @param Exception $exception wyjątek
	 * @return boolean
	 */
	public function exceptionHandler(Exception $exception) {
		ob_clean();
		//@TODO: uzależnić od środowiska
		$position = Mmi_Exception_Logger::log($exception);
		try {
			$view = Mmi_Controller_Front::getInstance()->getView();
			$view->_exceptionInfo = array(
				'message' => $exception->getMessage(),
				'file' => $position['file'],
				'line' => $position['line'],
				'info' => $position['info']
			);
			$actionHelper = new Mmi_Controller_Action_Helper_Action();
			$view->setPlaceholder('content', $actionHelper->action('default', 'error', 'index', array(), true));
			$view->displayLayout($view->skin, 'default', 'error');
		} catch (Exception $e) {
			echo '<html><body><h1>' . $exception->getMessage() . '</h1>' . nl2br($exception->getTraceAsString()) . '<h2>'. $e->getMessage() . '</h2></body></html>';
		}
		return true;
	}

	/**
	 * Ustawia kodowanie na UTF-8
	 * @return Mmi_Application
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
	 * @return Mmi_Application
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
	 * @return Mmi_Application
	 */
	protected function _initDefaultComponents() {
		require LIB_PATH . '/Mmi/Profiler.php';
		Mmi_Profiler::event('Application init');
		require LIB_PATH . '/Mmi/Application/Bootstrap/Interface.php';
		require LIB_PATH . '/Mmi/Application/Config.php';
		require LIB_PATH . '/Mmi/Config.php';
		require LIB_PATH . '/Mmi/Controller/Action/Helper/Abstract.php';
		require LIB_PATH . '/Mmi/Controller/Action/Helper/Action.php';
		require LIB_PATH . '/Mmi/Controller/Action/HelperBroker.php';
		require LIB_PATH . '/Mmi/Controller/Plugin/Abstract.php';
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
	 * @return Mmi_Application
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
	 * @return Mmi_Application
	 */
	protected function _initAutoloader() {
		spl_autoload_register(array($this, 'loader'));
		return $this;
	}

	/**
	 * Ustawia handler błędów
	 * @return Mmi_Application
	 */
	protected function _initErrorHandler() {
		set_exception_handler(array($this, 'exceptionHandler'));
		set_error_handler(array($this, 'errorHandler'));
		return $this;
	}

}
