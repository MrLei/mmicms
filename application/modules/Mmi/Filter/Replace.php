<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Mmi\Filter;

class Replace extends \Mmi\Filter\FilterAbstract {

	/**
	 * Zamienia znaki
	 * @param mixed $value wartość
	 * @throws Exception jeśli filtrowanie $value nie jest możliwe
	 * @return mixed
	 */
	public function filter($value) {
		$search = isset($this->_options[0]) ? $this->_options[0] : '';
		$replace = isset($this->_options[1]) ? $this->_options[1] : '';
		return str_replace($search, $replace, $value);
	}

}
