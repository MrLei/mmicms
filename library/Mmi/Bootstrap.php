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
 * Mmi/Bootstrap.php
 * @category   Mmi
 * @package    Mmi_Bootstrap
 * @copyright  Copyright (c) 2010 HQSoft Mariusz Miłejko (http://www.hqsoft.pl)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    $Id$
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */

/**
 * Przykładowa klasa startująca aplikacji
 * ustawia ścieżki, ładuje ogólną konfigurację
 * @category   Mmi
 * @package    Mmi_Bootstrap
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */
abstract class Mmi_Bootstrap {

	/**
	 * Konstruktor, ustawia ścieżki, ładuje domyślne klasy, ustawia autoloadera
	 * @param string $path ścieżka
	 */
	public function __construct($path) {

		$this->_initPaths($path)
			->_initEncoding()
			->_initPhpConfiguration()
			->_initDefaultComponents()
			->_initAutoloader()
			->_initErrorHandler();

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
			case ((substr($namespace, 0, 3) == 'Mmi') ? $namespace: !$namespace):
			case 'PHPExcel':
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
			throw new Exception($code . ': ' . $errstr . '[' . $errfile . ' (' . $errline.')]');
		}
		return true;
	}

	/**
	 * Obsługuje wyjątki
	 * @param Exception $exception wyjątek
	 * @return boolean
	 */
	public function exceptionHandler(Exception $exception) {
		@ob_clean();
		$position = $this->logException($exception);
		$view = Mmi_View::getInstance();
		$view->_exceptionInfo = array(
			'message' => $exception->getMessage(),
			'file' => $position['file'],
			'line' => $position['line'],
			'info' => $position['info']
		);
		$actionHelper = new Mmi_Controller_Action_Helper_Action();
		$view->setPlaceholder('content', $actionHelper->action('default', 'error', 'index', array(), true));
		$view->displayLayout($view->skin, 'default', 'error');
		return true;
	}

	/**
	 * Logowanie wyjątku
	 * @param Exception $exception
	 * @return array
	 */
	public function logException(Exception $exception) {
		$log = fopen(TMP_PATH . '/log/error.execution.log', 'a');
		$info = '';
		foreach ($exception->getTrace() as $position) {
			if (isset($position['file'])) {
				$info .= ' ' . $position['file'] . '(' . $position['line'] .'): '. $position['function']. "\n";
			}
		}
		$info = trim($info, "\n");
		$position['info'] = $info;
		$message = date('Y-m-d H:i:s') . ' ' . (isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] . "\n" : '') . strip_tags($exception->getMessage() . ': ' . $exception->getFile() . '(' . $exception->getLine() . ')' . $info);
		fwrite($log, $message . "\n\n");
		fclose($log);
		return $position;
	}

	/**
	 * Rejestracja pluginów, zwraca przygotowany front controller
	 * @return Mmi_Controller_Front
	 */
	public function registerPlugins() {
		$plugins = isset(Mmi_Config::$data['plugins']) ? Mmi_Config::$data['plugins'] : array();
		$front = Mmi_Controller_Front::getInstance();
		$front->setBootstrap($this);
		//rejestracja pluginów
		foreach ($plugins as $plugin) {
			$front->registerPlugin(new $plugin());
		}
		return $front;
	}

	/**
	 * Uruchamianie front-kontrolera
	 */
	public function run() {
		ob_start();
		$front = $this->registerPlugins();
		$front->dispatch();
		ob_end_flush();
	}

	/**
	 * Ustawia kodowanie na UTF-8
	 * @return \Mmi_Bootstrap
	 */
	protected function _initEncoding() {
		mb_internal_encoding('utf-8');
		ini_set('default_charset', 'utf-8');
		setlocale(LC_ALL, 'en_US.utf-8');
		return $this;
	}

	/**
	 * Definicja ścieżek
	 * @return \Mmi_Bootstrap
	 */
	protected function _initPaths($path) {
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
	 * @return \Mmi_Bootstrap
	 */
	protected function _initDefaultComponents() {
		//ładowanie domyślnych komponentów
		require LIB_PATH . '/Mmi/Cache/Backend/Interface.php';
		require LIB_PATH . '/Mmi/Cache/Backend/Apc.php';
		require LIB_PATH . '/Mmi/Cache/Config.php';
		require LIB_PATH . '/Mmi/Cache.php';
		require LIB_PATH . '/Mmi/Config.php';
		require LIB_PATH . '/Mmi/Profiler.php';
		require LIB_PATH . '/Mmi/Controller/Action/Helper/Abstract.php';
		require LIB_PATH . '/Mmi/Controller/Action/Helper/Action.php';
		require LIB_PATH . '/Mmi/Controller/Action/HelperBroker.php';
		require LIB_PATH . '/Mmi/Controller/Plugin/Abstract.php';
		require LIB_PATH . '/Mmi/Controller/Action.php';
		require LIB_PATH . '/Mmi/Controller/Front.php';
		require LIB_PATH . '/Mmi/Controller/Request.php';
		require LIB_PATH . '/Mmi/Controller/Response.php';
		require LIB_PATH . '/Mmi/Controller/Router/Config.php';
		require LIB_PATH . '/Mmi/Controller/Router.php';
		require LIB_PATH . '/Mmi/View.php';
		return $this;
	}

	/**
	 *
	 * @return \Mmi_Bootstrap
	 */
	protected function _initPhpConfiguration() {
		function _stripslashesGpc(&$value) {
			$value = stripslashes($value);
		}
		//obsługa włączonych magic quotes
		if (ini_get('magic_quotes_gpc')) {
			array_walk_recursive($_GET, array('_stripslashesGpc'));
			array_walk_recursive($_POST, array('_stripslashesGpc'));
			array_walk_recursive($_COOKIE, array('_stripslashesGpc'));
			array_walk_recursive($_REQUEST, array('_stripslashesGpc'));
		}
		return $this;
	}

	protected function _initAutoloader() {
		spl_autoload_register(array($this, 'loader'));
		return $this;
	}

	protected function _initErrorHandler() {
		set_exception_handler(array($this, 'exceptionHandler'));
		set_error_handler(array($this, 'errorHandler'));
		return $this;
	}

}