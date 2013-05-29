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
 * Mmi/Controller/Front.php
 * @category   Mmi
 * @package    Mmi_Controller
 * @copyright  Copyright (c) 2010 HQSoft Mariusz Miłejko (http://www.hqsoft.pl)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    $Id$
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */

/**
 * Front kontroler aplikacji
 * @category   Mmi
 * @package    Mmi_Controller
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */
class Mmi_Controller_Front {

	/**
	 * Instancja front kontrolera
	 * @var Mmi_Controller_Front
	 */
	private static $_instance;

	/**
	 * Bootstrap
	 * @var Mmi_Bootstrap
	 */
	private $_bootstrap;

	/**
	 * Request (żądanie)
	 * @var Mmi_Controller_Request
	 */
	private $_request;

	/**
	 * Response (odpowiedź)
	 * @var Mmi_Controller_Response
	 */
	private $_response;

	/**
	 * Lista pluginów
	 * @var array
	 */
	private $_plugins = array();

	/**
	 * Struktura aplikacji
	 * @var array
	 */
	private $_structure = array();

	/**
	 * Zabezpieczony konstruktor
	 */
	protected function __construct() {
		if (!Mmi_Config::$data['cache']['active'] || !($this->_structure = Mmi_Cache::getInstance()->load('Mmi_Structure'))) {
			$this->_structure = Mmi_Structure::getStructure();
			if (Mmi_Config::$data['cache']['active']) {
				Mmi_Cache::getInstance()->save($this->_structure, 'Mmi_Structure', 86400);
			}
		}
	}

	/**
	 * Pobranie instancji
	 * @return Mmi_Controller_Front
	 */
	public static function getInstance() {
		if (null === self::$_instance) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * Dodanie pluginu
	 * @param Mmi_Controller_Plugin_Abstract $plugin
	 */
	public function registerPlugin(Mmi_Controller_Plugin_Abstract $plugin) {
		$this->_plugins[] = $plugin;
	}

	/**
	 * Ustawienie żądania
	 * @param Mmi_Controller_Request $request
	 */
	public function setRequest(Mmi_Controller_Request $request) {
		$this->_request = $request;
	}

	/**
	 * Ustawienie odpowiedzi
	 * @param Mmi_Controller_Response $response
	 */
	public function setResponse(Mmi_Controller_Response $response) {
		$this->_response = $response;
	}

	/**
	 * Ustawienie bootstrapa
	 * @param Mmi_Bootstrap $bootstrap
	 */
	public function setBootstrap(Mmi_Bootstrap $bootstrap) {
		$this->_bootstrap = $bootstrap;
	}

	/**
	 * Pobranie żądania
	 * @return Mmi_Controller_Request
	 */
	public function getRequest() {
		return $this->_request;
	}

	/**
	 * Pobranie odpowiedzi
	 * @return Mmi_Controller_Response
	 */
	public function getResponse() {
		return $this->_response;
	}

	/**
	 * Pobieranie bootstrapa
	 * @return Mmi_Bootstrap $bootstrap
	 */
	public function getBootstrap() {
		return $this->_bootstrap;
	}

	/**
	 * Pobiera strukturę aplikacji
	 * @param string $part opcjonalnie można pobrać jedynie 'module', lub 'skin'
	 * @return array
	 */
	public function getStructure($part = null) {
		return (null === $part) ? $this->_structure : $this->_structure[$part];
	}

	/**
	 * Uruchamianie metody routeStartup na zarejestrowanych pluginach
	 */
	public function routeStartup() {
		foreach ($this->_plugins AS $plugin) {
			$plugin->routeStartup($this->_request);
		}
	}

	/**
	 * Uruchamianie metody preDispatch na zarejestrowanych pluginach
	 */
	public function preDispatch() {
		foreach ($this->_plugins AS $plugin) {
			$plugin->preDispatch($this->_request);
		}
	}

	/**
	 * Uruchamianie metody postDispatch na zarejestrowanych pluginach
	 */
	public function postDispatch() {
		foreach ($this->_plugins AS $plugin) {
			$plugin->postDispatch($this->_request);
		}
	}

	/**
	 * Dispatcher
	 */
	public function dispatch() {
		//ustawianie pustego żądania
		$this->setRequest(new Mmi_Controller_Request());
		//ustawianie pustej odpowiedzi
		$this->setResponse(new Mmi_Controller_Response());

		//wpięcie dla pluginów przed routingiem
		$this->routeStartup();

		//stosowanie routingu
		Mmi_Controller_Router::getInstance()->processRequest($this->getRequest());

		//wpięcie dla pluginów przed dispatchem
		$this->preDispatch();

		//wybór i uruchomienie kontrolera akcji (dispatch)
		$actionHelper = new Mmi_Controller_Action_Helper_Action();
		$content = $actionHelper->action($this->_request->__get('module'),
			$this->_request->__get('controller'),
			$this->_request->__get('action'),
			$this->_request->getUserParams(), true);

		//wpięcie dla pluginów po dispatchu
		$this->postDispatch();

		//wyświetlenie layoutu
		Mmi_View::getInstance()->setPlaceholder('content', $content);
		Mmi_View::getInstance()->displayLayout($this->_request->__get('skin'), $this->_request->__get('module'), $this->_request->__get('controller'));
	}

}
