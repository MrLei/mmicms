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
 * Mmi/Filter/Length.php
 * @category   Mmi
 * @package    \Mmi\Filter
 * @copyright  Copyright (c) 2013 HQSoft Mariusz Miłejko (http://www.hqsoft.pl)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    1.0.0
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */
/**
 * Klasa filtra określającego długość zmiennej
 * @category   Mmi
 * @package    \Mmi\Filter
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

namespace Mmi\Filter;

class Length extends \Mmi\Filter\FilterAbstract {

	/**
	 * Zliczanie długości
	 * @param mixed $value wartość
	 * @throws Exception jeśli filtrowanie $value nie jest możliwe
	 * @return int
	 */
	public function filter($value) {

		if (is_string($value) || is_numeric($value)) {
			return mb_strlen((string) $value);
		}
		if (is_array($value) || $value instanceof \ArrayObject) {
			return count($value);
		}
	}

}
