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
 * Mmi/Validate/Alnum.php
 * @category   Mmi
 * @package    \Mmi\Validate
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    1.0.0
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

/**
 * Klasa walidacji znaków alfanumerycznych
 * @category   Mmi
 * @package    \Mmi\Validate
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

namespace Mmi\Validate;

class Alnum extends ValidateAbstract {

	/**
	 * Treść wiadomości
	 */
	const INVALID = 'Ciąg zawiera znaki inne niż litery i cyfry';
	
	/**
	 * Walidacja znaków alfanumerycznych
	 * @param mixed $value wartość
	 * @return boolean
	 */
	public function isValid($value) {

		if (!is_string($value) && !is_int($value) && !is_float($value)) {
			$this->_error(self::INVALID);
			return false;
		}

		$filter = new \Mmi\Filter\Alnum();

		if ($filter->filter($value) != $value) {
			$this->_error(self::INVALID);
			return false;
		}
		return true;
	}
}