<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Mmi\Filter;

abstract class FilterAbstract {

	/**
	 * Opcje
	 * @var array
	 */
	protected $_options = array();

	/**
	 * Zwraca przefiltrowaną wartość
	 * @param mixed $value
	 * @throws Exception jeśli filtrowanie $value nie jest możliwe
	 * @return mixed
	 */
	abstract public function filter($value);

	/**
	 * Ustawia opcje - tabela klucz => wartość
	 * @param array $options opcje
	 * @return \Mmi\Filter\FilterAbstract
	 */
	public function setOptions(array $options = array()) {
		$this->_options = $options;
		return $this;
	}

	/**
	 * Ustawia pojedynczą opcję
	 * @param mixed $key klucz
	 * @param mixed $value wartość
	 * @return \Mmi\Filter\FilterAbstract
	 */
	public function setOption($key, $value) {
		$this->_options[$key] = $value;
		return $this;
	}

}
