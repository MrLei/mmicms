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
 * Mmi/Validate/Integer.php
 * @category   Mmi
 * @package    \Mmi\Validate
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    1.0.0
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

/**
 * Klasa walidacji liczb całkowitych
 * @category   Mmi
 * @package    \Mmi\Validate
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

namespace Mmi\Validate;

class Integer extends ValidateAbstract {

	/**
	 * Treść wiadomości
	 */
	const INVALID = 'Wprowadzona wartość nie jest liczbą całkowitą';
	
	/**
	 * Treść błędu o liczbie dodatniej
	 */
	const INVALID_POSITIVE = 'Wprowadzona wartość nie jest liczbą dodatnią';
	
	/**
	 * Walidacja liczb całkowitych
	 * @param mixed $value wartość
	 * @return boolean
	 */
	public function isValid($value) {
		$positive = (isset($this->_options['positive']) && $this->_options['positive']) ? true : false;
		if (!is_numeric($value)) {
			$this->_error(self::INVALID);
			return false;
		}
		if (!(intval($value) == $value)) {
			$this->_error(self::INVALID);
			return false;
		}
		if ($positive && !($value > 0)) {
			$this->_error(self::INVALID_POSITIVE);
			return false;
		}
		return true;
	}
}