<?php

/**
 * Mmi
 *
 * LICENSE
 *
 * Ten plik źródłowy objęty jest licencją BSD bez klauzuli ogłoszeniowej.
 * Licencja jest dostępna pod adresem: http://milejko.com/new-bsd.txt
 * W przypadku problemów, prosimy o kontakt na adres mariusz@milejko.pl
 *
 * Mmi/Validate/Ip4.php
 * @category   Mmi
 * @package    \Mmi\Validate
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    1.0.0
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */
/**
 * Klasa walidacji numeru IP
 * @category   Mmi
 * @package    \Mmi\Validate
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

namespace Mmi\Validate;

class Ip4 extends ValidateAbstract {

	/**
	 * Treść wiadomości
	 */
	const INVALID = 'Niepoprawny adres IP';

	/**
	 * Walidacja IPv4
	 * @param mixed $value wartość
	 * @return boolean
	 */
	public function isValid($value) {
		if (!preg_match('/^(?:[0-9]{1,3}\.){3}[0-9]{1,3}$/', $value)) {
			$this->_error(self::INVALID);
			return false;
		}
		foreach (explode('.', $value) as $num) {
			if ($num > 255 || $num < 0) {
				return false;
			}
		}
		return true;
	}

}
