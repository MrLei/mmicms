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
 * Mmi/Controller/Router.php
 * @category   Mmi
 * @package    Mmi_Controller
 * @copyright  Copyright (c) 2010 HQSoft Mariusz Miłejko (http://www.hqsoft.pl)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    $Id$
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */

/**
 * Klasa routera
 * @category   Mmi
 * @package    Mmi_Controller
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */
class Mmi_Controller_Router {

	/**
	 * Instancja
	 * @var Mmi_Controller_Router
	 */
	private static $_instance;

	/**
	 * Routy (trasy)
	 * @var array
	 */
	private $_routes = array();

	/**
	 * Ścieżka bazowa
	 * @var string
	 */
	private $_baseUrl;

	/**
	 * Pobiera instancję
	 * @return Mmi_Controller_Router
	 */
	public static function getInstance() {
		if (null === self::$_instance) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * Konstruktor, wczytuje trasy z konfiguracji
	 */
	protected function __construct() {

	}
	
	/**
	 * Ustaw routy (trasy)
	 * @param array $routes tablica rout (tras)
	 */
	public function setRoutes(array $routes = array()) {
		$this->_routes = $routes;
	}

	/**
	 * Pobiera request po ustawieniu parametrów routingu i danych wejściowych
	 * @return Mmi_Controller_Request
	 */
	public function processRequest(Mmi_Controller_Request $request) {
		$request->setParams($this->_decodeGet());
		$request->setParams($this->decodeUrl(trim(isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '', '/'), true));
		return $request;
	}

	/**
	 * Dekoduje URL na parametry żądania zgodnie z wczytanymi trasami
	 * @param string $url URL
	 * @param boolean $setBaseUrl jeśli prawdziwe, ustawi ścieżkę bazową w obiekcie
	 * @return array
	 */
	public function decodeUrl($url, $setBaseUrl = false) {
		$url = urldecode($url);

		if (!(false === strpos($url, '?'))) {
			$url = substr($url, 0, strpos($url, '?'));
		}
		$position = strpos($url, '/public');
		if ($position !== false && (substr($url, -7) == '/public' || substr($url, $position, 8) == '/public/')) {
			$baseUrl = substr($url, 0, $position + 7);
			$url = substr($url, $position + 8);
		}
		$baseUrl = isset($baseUrl) ? '/' . trim($baseUrl, '/') . '/' : '/';
		if ($setBaseUrl) {
			$this->setBaseUrl($baseUrl);
		}
		$url = trim($url, '/');
		$params = array();
		foreach ($this->_routes as $route) {
			$default = isset($route['default']) ? $route['default'] : array();
			$result = $this->_inputRouteApply($route['pattern'], $route['replace'], $default, $url);
			if ($result['matched']) {
				$params = isset($route['default']) ? $route['default'] : array();
				$params = array_merge($params, $result['params']);
				$url = $result['url'];
				break;
			}
		}
		$vars = explode('/', $url);
		if (!isset($params['lang'])) {
			if (strlen($vars[0]) == 2) {
				$params['lang'] = $vars[0];
				array_shift($vars);
			} else {
				$params['lang'] = isset(Mmi_Config::$data['global']['languages'][0]) ? Mmi_Config::$data['global']['languages'][0] : null;
			}
		}
		if (isset($vars[0]) && $vars[0]) {
			if (!isset($params['module'])) {
				$params['module'] = $vars[0];
				array_shift($vars);
			}
			if (isset($vars[0])) {
				if (!isset($params['controller'])) {
					$params['controller'] = $vars[0];
					array_shift($vars);
				}
				if (isset($vars[0])) {
					if (!isset($params['action'])) {
						$params['action'] = $vars[0];
						array_shift($vars);
					}
				}
			}
		}

		$params['module'] = isset($params['module']) ? $params['module'] : 'default';
		$params['controller'] = isset($params['controller']) ? $params['controller'] : 'index';
		$params['action'] = isset($params['action']) ? $params['action'] : 'index';

		for ($i = 0; $i < count($vars); $i++) {
			if (!isset($vars[$i]) || !$vars[$i]) {
				break;
			}
			$value = isset($vars[$i + 1]) ? $this->filter($vars[$i + 1]) : '';
			//obsługa tablic
			if (strpos($value, '0=') !== false) {
				parse_str($value, $value);
			}
			$params[$this->filter($vars[$i])] = $value;
			$i++;
		}
		if (!isset($params['skin'])) {
			$params['skin'] = isset(Mmi_Config::$data['global']['skin']) ? Mmi_Config::$data['global']['skin'] : 'default';
		}
		return $params;
	}

	/**
	 * Koduje parametry na URL zgodnie z wczytanymi trasami
	 * @param array $params parametry
	 * @return string
	 */
	public function encodeUrl(array $params = array()) {
		$url = rtrim($this->_baseUrl, '/');
		$lang = Mmi_Controller_Front::getInstance()->getRequest()->lang;
		$urlParams = '';
		$matched = array();
		foreach ($this->_routes as $route) {
			$currentParams = isset($route['default']) ? (array_merge($route['default'], $params)) : $params;
			unset($currentParams['skin']);
			if (!isset($currentParams['lang'])) {
				$currentParams['lang'] = $lang;
			}
			$result = $this->_outputRouteApply($route['pattern'], array_merge($route['default'], $route['replace']), $currentParams);
			if ($result['applied']) {
				$url .= '/' . $result['url'];
				$matched = $result['matched'];
				break;
			}
		}
		if (!isset($params['lang'])) {
			$params['lang'] = $lang;
		}
		$params['module'] = isset($params['module']) ? $params['module'] : 'default';
		$params['controller'] = isset($params['controller']) ? $params['controller'] : 'index';
		$params['action'] = isset($params['action']) ? $params['action'] : 'index';

		foreach ($matched as $match => $value) {
			unset($params[$match]);
		}

		if (isset($params['module']) && isset($params['controller']) && isset($params['action'])) {
			$module = $params['module'];
			$controller = $params['controller'];
			$action = $params['action'];
		}
		unset($params['module']);
		unset($params['controller']);
		unset($params['action']);
		unset($params['skin']);

		if (isset($params['lang']) && $params['lang'] != Mmi_Config::$data['global']['languages'][0]) {
			$url .= '/' . $params['lang'];
		}
		unset($params['lang']);

		if (isset($module)) {
			if (empty($params)) {
				if ($action == 'index') {
					$action = '';
					if ($controller == 'index') {
						$controller = '';
						if ($module == 'default') {
							$module = '';
						}
					}
				}
			}
			$url .= rtrim('/' . $module . '/' . $controller . '/' . $action, ' /');
		}
		foreach ($params as $key => $value) {
			if (is_array($value)) {
				$value = http_build_query($value);
			}
			$urlParams .= $key . '/' . $value . '/';
		}
		$url .= rtrim('/' . $urlParams, '/ ');
		if ($url == '') {
			$url = '/';
		}
		return $url;
	}

	/**
	 * Dekoduje GET na parametry żądania zgodnie z wczytanymi trasami
	 * @return array
	 */
	public function _decodeGet() {
		$params = array();
		foreach ($_GET as $key => $value) {
			$params[$this->filter($key)] = $this->filter($value);
		}
		$_GET = array();
		return $params;
	}

	/**
	 * Pobiera ścieżkę bazową
	 * @return string
	 */
	public function getBaseUrl() {
		return rtrim($this->_baseUrl, '/');
	}

	/**
	 * Ustawia ścieżkę bazową
	 * @param string $baseUrl
	 */
	public function setBaseUrl($baseUrl) {
		$this->_baseUrl = $baseUrl;
	}

	/**
	 * Filtruje string, lub tablicę (w sposób rekurencyjny)
	 * @param mixed $input zmienna wejściowa
	 * @return mixed
	 */
	public function filter($input) {
		if (!is_array($input)) {
			$input = str_replace('&amp;', '&', htmlspecialchars($input));
			if (get_magic_quotes_gpc()) {
				$input = stripslashes($input);
			}
		} elseif (is_array($input)) {
			$newInput = array();
			foreach ($input AS $key => $value) {
				$newInput[$key] = $this->filter($value);
			}
			$input = $newInput;
		}
		return $input;
	}

	/**
	 * Stosuje istniejące trasy dla danego url
	 * @param string $pattern wzór
	 * @param array $replace tablica zamian
	 * @param array $default tablica domyślnych wartości
	 * @param string $url URL
	 * @return array
	 */
	private function _inputRouteApply($pattern, array $replace, $default, $url) {
		$params = array();
		$matches = array();
		$matched = false;
		//sprawdzenie statyczne
		if ($pattern == $url) {
			$matched = true;
			$params = array_merge($default, $replace);
			return array(
				'matched' => true,
				'params' => array_merge($default, $replace),
				'url' => trim(substr($url, strlen($pattern)), ' /')
			);
		}
		//dopasowanie wyrażeniem regularnym
		if ($this->_isPatternRegular($pattern) && @preg_match($pattern, $url, $matches)) {
			$this->_tmpMatches = $matches;
			$this->_tmpDefault = $default;
			$matched = true;
			foreach ($replace as $key => $value) {
				$this->_tmpKey = $key;
				$params[$key] = preg_replace_callback('/\$([0-9]+)/', array($this, '_routeMatch'), $value);
				$params[$key] = preg_replace('/\|[a-z]+/', '', $params[$key]);
			}
			unset($this->_tmpMatches);
			unset($this->_tmpDefault);
			unset($this->_tmpKey);
			$url = trim(substr($url, strlen($matches[0])), ' /');
		}
		return array(
			'matched' => $matched,
			'params' => $params,
			'url' => $url
		);
	}

	/**
	 * Stosuje istniejące trasy dla tablicy parametrów (np. z żądania)
	 * @param string $pattern wzór
	 * @param array $replace tablica zamian
	 * @param array $params parametry
	 * @return array
	 */
	private function _outputRouteApply($pattern, array $replace, array $params) {
		$matches = array();
		$matched = array();
		$applied = true;
		$url = '';
		//routy statyczne tylko ze zgodną liczbą parametrów
		if (!$this->_isPatternRegular($pattern) && count($replace) != count($params)) {
			return array(
				'applied' => false,
				'matched' => $matched,
				'url' => $url
			);
		}
		foreach ($replace as $key => $value) {
			if (is_array($value) && isset($params[$key]) && $value == $params[$key]) {
				$matched[$key] = true;
				continue;
			} elseif (is_array($value)) {
				$applied = false;
				$matched = array();
				break;
			}
			if ((preg_match('/\$([0-9]+)(\|[a-z]+)?/', $value, $mt) && isset($params[$key]))) {
				if (!empty($mt) && count($mt) > 2) {
					$filter = Mmi_View::getInstance()->getFilter(ucfirst(ltrim($mt[2], '|')));
					$params[$key] = $filter->filter($params[$key]);
				}
				$matches[$value] = $params[$key];
			} elseif (!isset($params[$key]) || $params[$key] != $value) {
				$applied = false;
				$matched = array();
				break;
			}
			$matched[$key] = true;
		}
		if ($applied) {
			$pattern = str_replace(array('\\', '?'), '', trim($pattern, '/^$'));
			foreach ($matches as $match) {
				if (is_array($match)) {
					$match = trim(implode(';', $match), ';');
				}
				$pattern = substr($pattern, 0, strpos($pattern, '(')) . $match . substr($pattern, strpos($pattern, ')') + 1);
			}
			$url = $pattern;
		}
		return array(
			'applied' => $applied,
			'matched' => $matched,
			'url' => $url
		);
	}

	/**
	 * Sprawdzenie czy pattern to wyrażenie regularne
	 * @param string $pattern pattern
	 * @return bool
	 */
	private function _isPatternRegular($pattern) {
		return substr($pattern, 0, 1) == '/' && (substr($pattern, -1) == '/' || substr($pattern, -2) == '/i');
	}

	/**
	 * Callback dla zmieniania rout
	 * @param array $matches dopasowania
	 * @return mixed
	 * @throws Exception
	 */
	private function _routeMatch($matches) {
		if (!isset($matches[1])) {
			throw new Exception('Router failed due to invalid route definition');
		}
		if (isset($this->_tmpMatches[$matches[1]])) {
			return $this->_tmpMatches[$matches[1]];
		}
		if (isset($this->_tmpDefault[$this->_tmpKey])) {
			return $this->_tmpDefault[$this->_tmpKey];
		}
		throw new Exception('Router failed due to invalid route definition - no default param for key: ' . $this->_tmpKey);
	}

}