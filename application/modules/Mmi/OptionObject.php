<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Mmi;

abstract class OptionObject {

	/**
	 * Opcje pola
	 * @var array
	 */
	protected $_options = array();
	
	/**
	 * Ustawia opcję
	 * @param string $key klucz
	 * @param string $value wartość
	 * @return \Mmi\OptionObject
	 */
	public function setOption($key, $value) {
		$this->_options[$key] = $value;
		return $this;
	}
	
	/**
	 * Zwraca opcję po kluczu
	 * @param string $key klucz
	 * @return mixed
	 */
	public function getOption($key) {
		return isset($this->_options[$key]) ? $this->_options[$key] : null;
	}
	
	/**
	 * Usuwa opcję
	 * @param string $key klucz
	 * @return \Mmi\OptionObject
	 */
	public function unsetOption($key) {
		unset($this->_options[$key]);
		return $this;
	}
	
	/**
	 * Sprawdza istnienie opcji
	 * @param string $key klucz
	 * @return boolean
	 */
	public function issetOption($key) {
		return array_key_exists($key, $this->_options);
	}
	
	/**
	 * Ustawia wszystkie opcje na podstawie tabeli
	 * @param array $options tabela opcji
	 * @param boolean $reset usuwa poprzednie wartości (domyślnie nie)
	 * @return \Mmi\OptionObject
	 */
	public function setOptions(array $options = array(), $reset = false) {
		if ($reset) {
			$this->_options = $options;
		}
		foreach ($options as $key => $value) {
			$this->_options[$key] = $value;
		}
		return $this;
	}
	
	/**
	 * Zwraca wszystkie opcje
	 * @return array
	 */
	public function getOptions() {
		return $this->_options;
	}
	
}