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
 * Mmi/Validate/Between.php
 * @category   Mmi
 * @package    Mmi_Validate
 * @copyright  Copyright (c) 2010 HQSoft Mariusz Miłejko (http://www.hqsoft.pl)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    $Id$
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */

/**
 * Klasa walidacji liczb od-do
 * @category   Mmi
 * @package    Mmi_Validate
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */
class Mmi_Validate_NumberBetween extends Mmi_Validate_Abstract {

	/**
	 * Treść błędu 
	 */
	const INVALID = 'Wprowadzona wartość nie mieści się w wymaganym przedziale';

	public function isValid($value) {
		$from = isset($this->_options[0]) ? $this->_options[0] : 0;
		$to = isset($this->_options[1]) ? $this->_options[1] : 1000000000;
		if (($value < $from) || ($value > $to)) {
			$this->_error(self::INVALID);
			return false;
		}
		return true;
	}
}