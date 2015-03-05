<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Mmi\Controller;

class Router {

	/**
	 * Konfiguracja
	 * @var \Mmi\Controller\Router\Config
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
	 * @param \Mmi\Controller\Router\Config $config
	 * @param string $defaultLanguage domyślny język
	 * @param string $defaultSkin domyślna skóra
	 */
	public function __construct(\Mmi\Controller\Router\Config $config, $defaultLanguage = null, $defaultSkin = 'default') {
		$this->_config = $config;
		$this->_defaultLanguage = $defaultLanguage;
		$this->_defaultSkin = $defaultSkin;
		$this->_url = urldecode(trim(\Mmi\Controller\Front::getInstance()->getEnvironment()->requestUri, '/ '));;
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

	/**
	 * Pobiera konfigurację routera
	 * @return \Mmi\Controller\Router\Config
	 */
	public function getConfig() {
		return $this->_config;
	}

	/**
	 * Pobiera trasy
	 * @return array
	 */
	public function getRoutes() {
		return $this->_config->getRoutes();
	}

	/**
	 * Pobiera request po ustawieniu parametrów routingu i danych wejściowych
	 * @return \Mmi\Controller\Request
	 */
	public function processRequest(\Mmi\Controller\Request $request) {
		return $request->setParams($this->decodeUrl($this->_url));
	}

	/**
	 * Dekoduje URL na parametry żądania zgodnie z wczytanymi trasami
	 * @param string $url URL
	 * @return array
	 */
	public function decodeUrl($url) {
		//startowo parametry z GET
		$params = $this->_decodeGet();
		
		//filtracja url'a (bez GET)
		$url = html_entity_decode($url, ENT_HTML401 | ENT_HTML5 | ENT_QUOTES, 'UTF-8');
		
		//próba aplikacji rout
		foreach ($this->getRoutes() as $route) {
			/* @var $route \Mmi\Controller\Router\Config\Route */
			$result = $this->_inputRouteApply($route, $url);
			if ($result['matched']) {
				$params = $route->default;
				$params = array_merge($params, $result['params']);
				$url = $result['url'];
				break;
			}
		}
		
		//domyślne parametry
		$params['module'] = isset($params['module']) ? $params['module'] : 'core';
		$params['controller'] = isset($params['controller']) ? $params['controller'] : 'index';
		$params['action'] = isset($params['action']) ? $params['action'] : 'index';
		$params['skin'] = isset($params['skin']) ? $params['skin'] : $this->_defaultSkin;
		if ($this->_defaultLanguage) {
			$params['lang'] = isset($params['lang']) ? $params['lang'] : $this->_defaultLanguage;
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
		$matched = array();
		
		//aplikacja rout
		foreach ($this->getRoutes() as $route) {
			/* @var $route \Mmi\Controller\Router\Config\Route */
			$currentParams = array_merge($route->default, $params);
			$result = $this->_outputRouteApply($route, $currentParams);
			if ($result['applied']) {
				$url .= '/' . $result['url'];
				$matched = $result['matched'];
				break;
			}
		}
		//czyszczenie dopasowanych z routy
		foreach ($matched as $match => $value) {
			unset($params[$match]);
		}
		//czyszczenie modułu jeśli core
		if (isset($params['module']) && $params['module'] == 'core') {
			unset($params['module']);
		}
		//czyszczenie kontrolera jeśli index
		if (isset($params['controller']) && $params['controller'] == 'index') {
			unset($params['controller']);
		}
		//czyszczenie akcji jeśli index
		if (isset($params['action']) && $params['action'] == 'index') {
			unset($params['action']);
		}
		//budowanie zapytania
		if (!empty($params)) {
			$url .= '/?' . http_build_query($params);
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
	 * @param \Mmi\Controller\Router\Config\Route $route
	 * @param string $url URL
	 * @return array
	 */
	private function _inputRouteApply(\Mmi\Controller\Router\Config\Route $route, $url) {
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
	 * @param \Mmi\Controller\Router\Config\Route $route
	 * @param array $params parametry
	 * @return array
	 */
	private function _outputRouteApply(\Mmi\Controller\Router\Config\Route $route, array $params) {
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
					$filter = \Mmi\Controller\Front::getInstance()->getView()->getFilter(ucfirst(ltrim($mt[2], '|')));
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
			$url = preg_replace('/(\(.[^\)]+\))/', '(#)', $pattern);
			foreach ($matches as $match) {
				if (is_array($match)) {
					$match = trim(implode(';', $match), ';');
				}
				$url = preg_replace('/\(\#\)/', $match, $url, 1);
			}
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
			throw new\Exception('Router failed due to invalid route definition');
		}
		if (isset($this->_tmpMatches[$matches[1]])) {
			return $this->_tmpMatches[$matches[1]];
		}
		if (isset($this->_tmpDefault[$this->_tmpKey])) {
			return $this->_tmpDefault[$this->_tmpKey];
		}
		throw new\Exception('Router failed due to invalid route definition - no default param for key: ' . $this->_tmpKey);
	}

}
