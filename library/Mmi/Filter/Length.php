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
 * Mmi/Filter/Length.php
 * @category   Mmi
 * @package    Mmi_Filter
 * @copyright  Copyright (c) 2013 HQSoft Mariusz Miłejko (http://www.hqsoft.pl)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    $Id$
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */

/**
 * Klasa filtra określającego długość zmiennej
 * @category   Mmi
 * @package    Mmi_Filter
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */
class Mmi_Filter_Length extends Mmi_Filter_Abstract {

	/**
	 * Zliczanie długości
	 * @param mixed $value wartość
	 * @throws Exception jeśli filtrowanie $value nie jest możliwe
	 * @return int
	 */
	public function filter($value) {

		if (is_string($value) || is_numeric($value)) {
			return mb_strlen((string)$value);
		}
		if (is_array($value) || $value instanceof ArrayObject) {
			return count($value);
		}

	}

}
