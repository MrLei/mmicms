<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Mmi\Filter;

class StringTrim extends \Mmi\Filter\FilterAbstract {

	/**
	 * Usuwa spacę z końców ciągu znaków
	 * @param mixed $value wartość
	 * @throws Exception jeśli filtrowanie $value nie jest możliwe
	 * @return mixed
	 */
	public function filter($value) {
		$chars = ' ';
		if (isset($this->_options[0])) {
			$chars = ' ' . $this->_options[0];
		}
		return trim($value, $chars);
	}

}
