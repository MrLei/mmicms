<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Mmi\Controller\Router;

/**
 * Obiekt konfiguracji routera
 */
class Config {

	/**
	 * Dane rout
	 * @var type
	 */
	protected $_data = array();

	/**
	 * Tworzy (lub nadpisuje) routę
	 * @param string $name nazwa lub indeks
	 * @param string $pattern wyrażenie regularne lub plain
	 * @param array $replace tablica zastąpień
	 * @param array $default tablica wartości domyślnych
	 * @return \Mmi\Controller\Router\Config
	 */
	public function setRoute($name, $pattern, array $replace = array(), array $default = array()) {
		$route = new \Mmi\Controller\Router\Config\Route();
		$route->name = $name;
		$route->pattern = $pattern;
		$route->replace = $replace;
		$route->default = $default;
		return $this->addRoute($route);
	}

	/**
	 * Dodaje routę do stosu rout
	 * @param \Mmi\Controller\Router\Config\Route $route
	 * @return \Mmi\Controller\Router\Config
	 */
	public function addRoute(\Mmi\Controller\Router\Config\Route $route) {
		$this->_data[$route->name] = $route;
		return $this;
	}
	
	/**
	 * Ustawia routy
	 * @param array $routes tablica z obiektami rout
	 * @param boolean $replace czy zastąpić obecną tablicę
	 * @return \Mmi\Controller\Router\Config
	 */
	public function setRoutes(array $routes, $replace = false) {
		if ($replace) {
			$this->_data = array();
		}
		//dodaje routy z tablicy
		foreach ($routes as $route) {
			/* @var $route \Mmi\Controller\Router\Config\Route */
			$this->addRoute($route);
		}
		return $this;
	}

	/**
	 * Pobierz routę
	 * @param string $name nazwa lub indeks
	 * @return \Mmi\Controller\Router\Config\Route
	 */
	public function getRoute($name) {
		if (!$this->isRoute($name)) {
			return null;
		}
		return $this->_data[$name];
	}

	/**
	 * Zwraca wszystkie skonfigurowane routy
	 * @return array
	 */
	public function getRoutes() {
		return $this->_data;
	}

	/**
	 * Sprawdza istnienie routy
	 * @param string $name nazwa lub indeks
	 * @return boolean
	 */
	public function isRoute($name) {
		return isset($this->_data[$name]);
	}

}
