<?php

/**
 * Mmi
 *
 * LICENSE
 *
 * Ten plik źródłowy objęty jest licencją BSD bez klauzuli ogłoszeniowej.
 * Licencja jest dostępna pod adresem: http://www.hqsoft.pl/new-bsd
 * W przypadku problemów, prosimy o kontakt na adres office@hqsoft.pl
 *
 * Mmi/Validate/Ip4.php
 * @category   Mmi
 * @package    Mmi_Validate
 * @copyright  Copyright (c) 2010 HQSoft Mariusz Miłejko (http://www.hqsoft.pl)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    $Id$
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */

/**
 * Klasa walidacji numeru IP
 * @category   Mmi
 * @package    Mmi_Validate
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */
class Mmi_Validate_Ip4 extends Mmi_Validate_Abstract {

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
