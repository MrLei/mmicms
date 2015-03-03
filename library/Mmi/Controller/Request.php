<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Mmi\Controller;

class Request {

	/**
	 * Zmienne żądania
	 * @var array
	 */
	private $_data = array();

	/**
	 * Konstruktor, pozwala podać zmienne requestu
	 * @param array $data zmienne requestu
	 */
	public function __construct(array $data = array()) {
		$this->setParams($data);
	}

	/**
	 * Magiczne pobranie zmiennej żądania
	 * @param string $key klucz
	 * @return string
	 */
	public function __get($key) {
		return isset($this->_data[$key]) ? $this->_data[$key] : null;
	}

	/**
	 * Magiczne sprawczenie istnienia pola
	 * @param string $key klucz
	 * @return bool
	 */
	public function __isset($key) {
		return isset($this->_data[$key]);
	}

	/**
	 * Magicznie usuwa pole
	 * @param string $key klucz
	 */
	public function __unset($key) {
		unset($this->_data[$key]);
	}

	/**
	 * Magiczne ustawienie zmiennej żądania
	 * @param string $key klucz
	 * @param string $value wartość
	 */
	public function __set($key, $value) {
		$this->_data[$key] = $value;
	}

	/**
	 * Zwraca Content-Type żądania
	 * @return string
	 */
	public function getContentType() {
		return filter_input(INPUT_SERVER, 'CONTENT_TYPE', FILTER_SANITIZE_SPECIAL_CHARS);
	}

	/**
	 * Zwraca metodę żądania (np. GET, POST, PUT)
	 * @return string
	 */
	public function getRequestMethod() {
		return filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_SANITIZE_SPECIAL_CHARS);
	}

	/**
	 * Pobiera nagłówek żądania
	 * @param string $name np. Accept-Encoding
	 * @return string
	 */
	public function getHeader($name) {
		$headerName = strtoupper(preg_replace("/[^a-zA-Z0-9_]/", '_', $name));
		return filter_input(INPUT_SERVER, 'HTTP_' . $headerName, FILTER_SANITIZE_SPECIAL_CHARS);
	}

	/**
	 * Zwraca zmienne żądania w formie tabeli
	 * @return array
	 */
	public function toArray() {
		return $this->_data;
	}

	/**
	 * Ustawia wszystkie zmienne żądania
	 * @param array $data parametry
	 * @param bool $reset usuwa wcześniej istniejące parametry
	 */
	public function setParams(array $data = array(), $reset = false) {
		if ($reset) {
			$this->_data = array();
		}
		foreach ($data as $key => $value) {
			$this->_data[$key] = $value;
		}
		return $this;
	}

	/**
	 * Zwraca zmienne POST w postaci tabeli
	 * @return array
	 */
	public function getPost() {
		return new Request\Post($_POST);
	}

	/**
	 * Pobiera informacje o zuploadowanych plikach FILES
	 * @return array
	 */
	public function getFiles() {
		return new Request\File($_FILES);
	}

	/**
	 * Zwraca referer, lub stronę główną jeśli brak
	 * @return string
	 */
	public function getReferer() {
		return \Mmi\Controller\Front::getInstance()->getEnvironment()->httpReferer;
	}

	/**
	 * Zwraca moduł
	 * @return string
	 */
	public function getModuleName() {
		return $this->__get('module');
	}

	/**
	 * Zwraca kontroler
	 * @return string
	 */
	public function getControllerName() {
		return $this->__get('controller');
	}

	/**
	 * Zwraca akcję
	 * @return string
	 */
	public function getActionName() {
		return $this->__get('action');
	}

	/**
	 * Ustawia moduł
	 * @param string $value
	 * @return \Mmi\Controller\Request
	 */
	public function setModuleName($value) {
		$this->__set('module', $value);
		return $this;
	}

	/**
	 * Ustawia kontroler
	 * @param string $value
	 * @return \Mmi\Controller\Request
	 */
	public function setControllerName($value) {
		$this->__set('controller', $value);
		return $this;
	}

	/**
	 * Ustawia akcję
	 * @param string $value
	 * @return \Mmi\Controller\Request
	 */
	public function setActionName($value) {
		$this->__set('action', $value);
		return $this;
	}

	/**
	 * Ustawia nazwę skóry
	 * @param string $value
	 * @return \Mmi\Controller\Request
	 */
	public function setSkinName($value) {
		$this->__set('skin', $value);
		return $this;
	}

}
