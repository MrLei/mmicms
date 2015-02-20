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
 * Mmi/Validate/Numeric.php
 * @category   Mmi
 * @package    \Mmi\Validate
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    1.0.0
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

/**
 * Klasa walidacji liczb
 * @category   Mmi
 * @package    \Mmi\Validate
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

namespace Mmi\Validate;

class Numeric extends ValidateAbstract {

	/**
	 * Treść wiadomości
	 */
	const INVALID = 'Wprowadzona wartość nie jest liczbą';
	
	/**
	 * Walidacja liczb
	 * @param mixed $value wartość
	 * @return boolean
	 */
	public function isValid($value) {
		if (!is_numeric($value)) {
			$this->_error(self::INVALID);
			return false;
		}
		return true;
	}
}