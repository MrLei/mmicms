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
	 * Konfiguracja
	 * @var Mmi_Controller_Router_Config
	 */
	private $_config;

	/**
	 * Ścieżka bazowa zapytania
	 * @var string
	 */
	private $_baseUrl;

	/**
	 * Url zapytania
	 * @var string
	 */
	private $_url;

	/**
	 * Domyślny język
	 * @var string
	 */
	private $_defaultLanguage;

	/**
	 * Domyślna skóra
	 * @var string
	 */
	private $_defaultSkin;

	/**
	 *
	 * @param Mmi_Controller_Router_Config $config
	 * @param string $defaultLang domyślny język
	 * @param string $defaultSkin domyślna skóra
	 */
	public function __construct(Mmi_Controller_Router_Config $config, $defaultLanguage = null, $defaultSkin = 'default') {
		$this->_config = $config;
		$this->_defaultLanguage = $defaultLanguage;
		$this->_defaultSkin = $defaultSkin;
		$requestUri = Mmi_Controller_Front::getInstance()->getEnvironment()->requestUri;
		$this->_url = urldecode(trim($requestUri, '/ '));
		if (!(false === strpos($this->_url, '?'))) {
			$this->_url = substr($this->_url, 0, strpos($this->_url, '?'));
		}
		//obsługa serwisu w podkatalogu
		$subFolderPath = substr(BASE_PATH, strrpos(BASE_PATH, '/') + 1) . '/public';
		$position = strpos($this->_url, $subFolderPath);
		if ($position !== false) {
			$this->_baseUrl = substr($this->_url, 0, strlen($subFolderPath) + $position);
			$this->_url = substr($this->_url, strlen($subFolderPath) + $position + 1);
		}
		$this->_baseUrl = isset($this->_baseUrl) ? '/' . trim($this->_baseUrl, '/') : '';
		$this->_url = rtrim($this->_url, '/');
	}

	public function getRoutes() {
		if ($this->_config === null) {
			return array();
		}
		return $this->_config->getRoutes();
	}

	/**
	 * Pobiera request po ustawieniu parametrów routingu i danych wejściowych
	 * @return Mmi_Controller_Request
	 */
	public function processRequest(Mmi_Controller_Request $request) {

		$request->setParams($this->decodeUrl($this->_url));
		$request->setParams($this->_decodeGet());
		return $request;
	}

	/**
	 * Dekoduje URL na parametry żądania zgodnie z wczytanymi trasami
	 * @param string $url URL
	 * @return array
	 */
	public function decodeUrl($url) {
		$params = array();
		$url = html_entity_decode($url, ENT_HTML401 | ENT_HTML5 | ENT_QUOTES, 'UTF-8');
		foreach ($this->getRoutes() as $route) {
			/* @var $route Mmi_Controller_Router_Config_Route */
			$result = $this->_inputRouteApply($route, $url);
			if ($result['matched']) {
				$params = $route->default;
				$params = array_merge($params, $result['params']);
				$url = $result['url'];
				break;
			}
		}
		$vars = explode('/', $url);
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
			$valueLength = strlen($value);
			if ($valueLength > 0 && $value[0] == '(' && $value[$valueLength - 1] == ')') {
				$value = explode(';', rtrim(ltrim($value, '('), ')'));
				if (!is_array($value)) {
					$value = array($value);
				}
			}
			$params[$this->filter($vars[$i])] = $value;
			$i++;
		}
		if (!isset($params['skin'])) {
			$params['skin'] = $this->_defaultSkin;
		}
		if (!isset($params['lang']) && $this->_defaultLanguage !== null) {
			$params['lang'] = $this->_defaultLanguage;
		}
		return $params;
	}

	/**
	 * Koduje parametry na URL zgodnie z wczytanymi trasami
	 * @param array $params parametry
	 * @return string
	 */
	public function encodeUrl(array $params = array()) {
		$url = $this->_baseUrl;
		$urlParams = '';
		$matched = array();
		foreach ($this->getRoutes() as $route) {
			/* @var $route Mmi_Controller_Router_Config_Route */
			$currentParams = array_merge($route->default, $params);
			$result = $this->_outputRouteApply($route, $currentParams);
			if ($result['applied']) {
				$url .= '/' . $result['url'];
				$matched = $result['matched'];
				break;
			}
		}
		//dopasowanie bez lang i skin
		if ((isset($params['skin']) || isset($params['lang'])) && empty($matched)) {
			unset($params['skin']);
			unset($params['lang']);
			foreach ($this->getRoutes() as $route) {
				/* @var $route Mmi_Controller_Router_Config_Route */
				$currentParams = array_merge($route->default, $params);
				$result = $this->_outputRouteApply($route, $currentParams);
				if ($result['applied']) {
					$url .= '/' . $result['url'];
					$matched = $result['matched'];
					break;
				}
			}
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
				$value = '(' . implode(';', $value) . ')';
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
		return $params;
	}

	/**
	 * Pobiera ścieżkę bazową
	 * @return string
	 */
	public function getBaseUrl() {
		return $this->_baseUrl;
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
	 * @param Mmi_Controller_Router_Config_Route $route
	 * @param string $url URL
	 * @return array
	 */
	private function _inputRouteApply(Mmi_Controller_Router_Config_Route $route, $url) {
		$params = array();
		$matches = array();
		$matched = false;
		//sprawdzenie statyczne
		if ($route->pattern == $url) {
			$matched = true;
			$params = array_merge($route->default, $route->replace);
			return array(
				'matched' => true,
				'params' => $params,
				'url' => trim(substr($url, strlen($route->pattern)), ' /')
			);
		}
		//dopasowanie wyrażeniem regularnym
		if ($this->_isPatternRegular($route->pattern) && @preg_match($route->pattern, $url, $matches)) {
			$this->_tmpMatches = $matches;
			$this->_tmpDefault = $route->default;
			$matched = true;
			foreach ($route->replace as $key => $value) {
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
	 * @param Mmi_Controller_Router_Config_Route $route
	 * @param array $params parametry
	 * @return array
	 */
	private function _outputRouteApply(Mmi_Controller_Router_Config_Route $route, array $params) {
		$matches = array();
		$matched = array();
		$applied = true;
		$url = '';
		$replace = array_merge($route->default, $route->replace);
		//routy statyczne tylko ze zgodną liczbą parametrów
		if (!$this->_isPatternRegular($route->pattern) && count($replace) != count($params)) {
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
					$filter = Mmi_Controller_Front::getInstance()->getView()->getFilter(ucfirst(ltrim($mt[2], '|')));
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
			$pattern = str_replace(array('\\', '?'), '', trim($route->pattern, '/^$'));
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
