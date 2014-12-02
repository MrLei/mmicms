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
 * Mmi/Validate/StringLength.php
 * @category   Mmi
 * @package    Mmi_Validate
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    1.0.0
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

/**
 * Klasa walidacji długości ciągu
 * @category   Mmi
 * @package    Mmi_Validate
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */
class Mmi_Validate_StringLength extends Mmi_Validate_Abstract {

	/**
	 * Komunikat niedostatecznej długości
	 */
	const SHORT = 'Tekst jest zbyt krótki';

	/**
	 * Komunikat nadmiernej długości
	 */
	const LONG = 'Tekst jest zbyt długi';

	/**
	 * Waliduje długość ciągu, długość zadana jest w opcjach (przy konstruktorze)
	 * w tabeli postaci array(minimum, maksimum)
	 * @param string $value
	 * @return boolean
	 */
	public function isValid($value) {
		$short = isset($this->_options[0]) ? $this->_options[0] : 0;
		$long = isset($this->_options[1]) ? $this->_options[1] : 255;
		if (strlen($value) < $short) {
			$this->_error(self::SHORT);
			return false;
		}
		if (strlen($value) > $long) {
			$this->_error(self::LONG);
			return false;
		}
		return true;
	}
}