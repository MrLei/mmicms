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
 * Mmi/Validate/Numeric.php
 * @category   Mmi
 * @package    Mmi_Validate
 * @copyright  Copyright (c) 2010 HQSoft Mariusz Miłejko (http://www.hqsoft.pl)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    $Id$
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */

/**
 * Klasa walidacji liczb
 * @category   Mmi
 * @package    Mmi_Validate
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */
class Mmi_Validate_Numeric extends Mmi_Validate_Abstract {

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