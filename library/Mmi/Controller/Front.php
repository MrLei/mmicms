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
 * Mmi/Controller/Front.php
 * @category   Mmi
 * @package    \Mmi\Controller
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    1.0.0
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */
/**
 * Front kontroler aplikacji
 * @category   Mmi
 * @package    \Mmi\Controller
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

namespace Mmi\Controller;

class Front {

	/**
	 * Instancja front kontrolera
	 * @var \Mmi\Controller\Front
	 */
	private static $_instance;

	/**
	 * Request (żądanie)
	 * @var \Mmi\Controller\Request
	 */
	private $_request;

	/**
	 * Response (odpowiedź)
	 * @var \Mmi\Controller\Response
	 */
	private $_response;

	/**
	 * Router
	 * @var \Mmi\Controller\Router
	 */
	private $_router;

	/**
	 * Środowisko uruchomieniowe
	 * @var \Mmi\Controller\Environment
	 */
	private $_environment;

	/**
	 * Widok
	 * @var \Mmi\View
	 */
	private $_view;

	/**
	 * Lista pluginów
	 * @var array
	 */
	private $_plugins = array();

	/**
	 * Struktura aplikacji
	 * @var array
	 */
	private $_structure;

	/**
	 * Zabezpieczony konstruktor
	 */
	protected function __construct() {
		$this->_request = new \Mmi\Controller\Request();
		$this->_response = new \Mmi\Controller\Response();
		$this->_environment = new \Mmi\Controller\Environment();
	}

	/**
	 * Pobranie instancji
	 * @return \Mmi\Controller\Front
	 */
	public static function getInstance() {
		if (null === self::$_instance) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * Ustawia strukturę frontu
	 * @param array $structure
	 * @return \Mmi\Controller\Front
	 */
	public function setStructure(array $structure = array()) {
		$this->_structure = $structure;
		return $this;
		}

		/**
		 * Dodanie pluginu
		 * @param \Mmi\Controller\Plugin\Abstract $plugin
		 * @return \Mmi\Controller\Front
		 */
		public function registerPlugin(\Mmi\Controller\Plugin\PluginAbstract $plugin) {
		$this->_plugins[] = $plugin;
		return $this;
	}

	/**
	 * Ustawienie żądania
	 * @param \Mmi\Controller\Request $request
	 * @return \Mmi\Controller\Front
	 */
	public function setRequest(\Mmi\Controller\Request $request) {
		$this->_request = $request;
		return $this;
	}

	/**
	 * Ustawienie odpowiedzi
	 * @param \Mmi\Controller\Response $response
	 * @return \Mmi\Controller\Front
	 */
	public function setResponse(\Mmi\Controller\Response $response) {
		$this->_response = $response;
		return $this;
	}

	/**
	 * Ustawia router
	 * @param \Mmi\Controller\Router $router
	 * @return \Mmi\Controller\Front
	 */
	public function setRouter(\Mmi\Controller\Router $router) {
		$this->_router = $router;
		return $this;
	}

	/**
	 * Ustawia widok
	 * @param \Mmi\View $view
	 * @return \Mmi\Controller\Front
	 */
	public function setView(\Mmi\View $view) {
		$this->_view = $view;
		return $this;
	}

	/**
	 * Pobranie żądania
	 * @return \Mmi\Controller\Request
	 */
	public function getRequest() {
		return $this->_request;
	}

	/**
	 * Pobranie odpowiedzi
	 * @return \Mmi\Controller\Response
	 */
	public function getResponse() {
		return $this->_response;
	}

	/**
	 * Pobranie routera
	 * @return \Mmi\Controller\Router
	 */
	public function getRouter() {
		if ($this->_router === null) {
			throw new Exception('\Mmi\Controller\Front: no router specified');
		}
		return $this->_router;
	}

	/**
	 * Pobiera środowisko uruchomieniowe
	 * @return \Mmi\Controller\Environment
	 */
	public function getEnvironment() {
		return $this->_environment;
	}

	/**
	 * Pobranie widoku
	 * @return \Mmi\View
	 */
	public function getView() {
		if ($this->_view === null) {
			throw new Exception('\Mmi\Controller\Front: no view specified');
		}
		return $this->_view;
	}

	/**
	 * Pobiera strukturę aplikacji
	 * @param string $part opcjonalnie można pobrać jedynie 'module', lub 'skin'
	 * @return array
	 */
	public function getStructure($part = null) {
		if ($this->_structure === null) {
			throw new Exception('\Mmi\Contoller\Front structure not found');
		}
		if ($part !== null && !isset($this->_structure[$part])) {
			throw new Exception('\Mmi\Controller\Front structure invalid');
		}
		return (null === $part) ? $this->_structure : $this->_structure[$part];
	}

	/**
	 * Uruchamianie metody routeStartup na zarejestrowanych pluginach
	 */
	public function routeStartup() {
		foreach ($this->_plugins as $plugin) {
			$plugin->routeStartup($this->_request);
		}
	}

	/**
	 * Uruchamianie metody preDispatch na zarejestrowanych pluginach
	 */
	public function preDispatch() {
		foreach ($this->_plugins as $plugin) {
			$plugin->preDispatch($this->_request);
		}
	}

	/**
	 * Uruchamianie metody postDispatch na zarejestrowanych pluginach
	 */
	public function postDispatch() {
		foreach ($this->_plugins as $plugin) {
			$plugin->postDispatch($this->_request);
		}
	}

	/**
	 * Dispatcher
	 */
	public function dispatch() {
		//wpięcie dla pluginów przed routingiem
		$this->routeStartup();
		\Mmi\Profiler::event('Plugins route startup');

		//stosowanie routingu jeśli request jest pusty
		if (!$this->_request->getModuleName()) {
			$this->getRouter()->processRequest($this->_request);
			\Mmi\Profiler::event('Routes applied');
		}

		//wpięcie dla pluginów przed dispatchem
		$this->preDispatch();
		\Mmi\Profiler::event('Plugins pre-dispatch');

		//wybór i uruchomienie kontrolera akcji
		$actionHelper = new \Mmi\Controller\Action\Helper\Action();
		$content = $actionHelper->action($this->getRequest()->__get('module'), $this->getRequest()->__get('controller'), $this->getRequest()->__get('action'), $this->getRequest()->getUserParams());

		//wpięcie dla pluginów po dispatchu
		$this->postDispatch();
		\Mmi\Profiler::event('Plugins post-dispatch');

		//przekazanie wykonanych widoków do response
		if (!$this->getView()->isLayoutDisabled()) {
			$content = $this->getView()
				->setRequest($this->_request)
				->setPlaceholder('content', $content)
				->renderLayout($this->_request->__get('skin'), $this->_request->__get('module'), $this->_request->__get('controller'));
		}

		//wysłanie odpowiedzi
		$this->getResponse()
			->setContent($content)
			->send();
	}

}
