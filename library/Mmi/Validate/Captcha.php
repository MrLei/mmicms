<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Mmi\Validate;

class Captcha extends ValidateAbstract {

	const INVALID = 'Przepisany kod jest niepoprawny';

	/**
	 * Waliduje poprawność captcha
	 * @param string $value
	 * @return boolean
	 */
	public function isValid($value) {
		$this->_error(self::INVALID);
		$session = new \Mmi\Session\Space('\Mmi\Form');
		$name = 'captcha-' . $this->_options['name'];
		return ($session->$name == strtoupper($value));
	}

}
