<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Mmi\Validate;

class Date extends ValidateAbstract {

	/**
	 * Treść wiadomości
	 */
	const INVALID = 'Wprowadzona wartość nie jest poprawną datą';

	/**
	 * Walidacja daty
	 * @param mixed $value wartość
	 * @return boolean
	 */
	public function isValid($value) {
		if (!strtotime($value)) {
			$this->_error(self::INVALID);
			return false;
		}
		return true;
	}

}
