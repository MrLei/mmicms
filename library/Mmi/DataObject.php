<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Mmi;

abstract class DataObject {
	
	/**
	 * Dane
	 * @var array
	 */
	protected $_data = array();
	
	/**
	 * Magicznie pobiera zmienną
	 * @param string $key klucz
	 * @return mixed
	 */
	public function __get($key) {
		return isset($this->_data[$key]) ? $this->_data[$key] : null;
	}

	/**
	 * Magicznie ustawia zmienną
	 * @param string $key klucz
	 * @param mixed $value wartość
	 */
	public function __set($key, $value) {
		$this->_data[$key] = $value;
	}

	/**
	 * Magicznie sprawdza istnienie zmiennej
	 * @param string $key klucz
	 * @return boolean
	 */
	public function __isset($key) {
		return isset($this->_data[$key]);
	}

	/**
	 * Magicznie usuwa zmienną
	 * @param string $key klucz
	 */
	public function __unset($key) {
		unset($this->_data[$key]);
	}
	
	/**
	 * Ustawia wszystkie zmienne
	 * @param array $data parametry
	 * @param bool $reset usuwa wcześniej istniejące parametry
	 * @return \Mmi\DataObject
	 */
	public function setParams(array $data = array(), $reset = false) {
		if ($reset) {
			$this->_data = $data;
		}
		foreach ($data as $key => $value) {
			$this->_data[$key] = $value;
		}
		return $this;
	}
	
	/**
	 * Zwraca wszystkie dane w formie tabeli
	 * @return array
	 */
	public function toArray() {
		return $this->_data;
	}

}