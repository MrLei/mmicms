<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Mmi\Controller\Request;

class Post {
	
	/**
	 * Dane POST
	 * @var array
	 */
	protected $_data = array();
	
	/**
	 * Konstruktor
	 * @param array $post dane z POST
	 */
	public function __construct(array $post = array()) {
		$this->_data = $post;
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
	 * Zwraca POST jako array
	 * @return array
	 */
	public function toArray() {
		return $this->_data;
	}
	
}