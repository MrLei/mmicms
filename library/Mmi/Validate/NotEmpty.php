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
 * Mmi/Validate/NotEmpty.php
 * @category   Mmi
 * @package    Mmi_Validate
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    1.0.0
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

/**
 * Klasa walidacji niepustości
 * @category   Mmi
 * @package    Mmi_Validate
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */
class Mmi_Validate_NotEmpty extends Mmi_Validate_Abstract {

	/**
	 * Treść wiadomości
	 */
	const INVALID = 'Pole nie może być puste';
	
	/**
	 * Walidacja niepustości
	 * @param mixed $value wartość
	 * @return boolean
	 */
	public function isValid($value) {
		if (!is_null($value) && !is_string($value) && !is_int($value) && !is_float($value) &&
				!is_bool($value) && !is_array($value)) {
			$this->_error(self::INVALID);
			return false;
		}
		if (is_string($value)
				&& (('' === $value)
				|| preg_match('/^\s+$/s', $value))
		) {
			$this->_error(self::INVALID);
			return false;
		} elseif (is_int($value) && (0 === $value)) {
			return true;
		} elseif (!is_string($value) && empty($value)) {
			$this->_error(self::INVALID);
			return false;
		}
		return true;
	}
}