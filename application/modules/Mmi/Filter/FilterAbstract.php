<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Mmi\Filter;

abstract class FilterAbstract extends \Mmi\OptionObject {

	/**
	 * Zwraca przefiltrowaną wartość
	 * @param mixed $value
	 * @throws Exception jeśli filtrowanie $value nie jest możliwe
	 * @return mixed
	 */
	abstract public function filter($value);

}
