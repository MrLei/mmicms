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
 * Mmi/Validate/EmailAddress.php
 * @category   Mmi
 * @package    Mmi_Validate
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    1.0.0
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

/**
 * Klasa walidacji adresu e-maill
 * @category   Mmi
 * @package    Mmi_Validate
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */
class Mmi_Validate_EmailAddress extends Mmi_Validate_Abstract {
	/**
	 * Komunikat niedostatecznej długości
	 */

	const ERROR = 'Niepoprawny adres e-mail';

	/**
	 * Sprawdza czy tekst jest e-mailem
	 * @param string $value
	 * @return boolean
	 */
	public function isValid($value) {
		if (preg_match('/^([*+!.&#$¦\'\\%\/0-9a-z^_`{}=?~:-]+)@(([0-9a-z-]+\.)+[0-9a-z]{2,4})$/i', $value)) {
			return true;
		}
		$this->_error(self::ERROR);
		return false;
	}

}