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
 * Mmi/Validate/Integer.php
 * @category   Mmi
 * @package    Mmi_Validate
 * @copyright  Copyright (c) 2010 HQSoft Mariusz Miłejko (http://www.hqsoft.pl)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    $Id$
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */

/**
 * Klasa walidacji liczb całkowitych
 * @category   Mmi
 * @package    Mmi_Validate
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */
class Mmi_Validate_Integer extends Mmi_Validate_Abstract {

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