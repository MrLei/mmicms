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
 * Mmi/Filter/Iban.php
 * @category   Mmi
 * @package    \Mmi\Filter
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    1.0.0
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */
/**
 * Filtr poprawiający wygląd numerów IBAN
 * @category   Mmi
 * @package    \Mmi\Filter
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

namespace Mmi\Filter;

class Iban extends \Mmi\Filter\FilterAbstract {

	/**
	 * Poprawia wygląd numerów IBAN
	 * @param mixed $value wartość
	 * @throws Exception jeśli filtrowanie $value nie jest możliwe
	 * @return mixed
	 */
	public function filter($value) {
		$defaultCountry = isset($this->_options[0]) ? $this->_options[0] : 'PL';
		$useSpaces = isset($this->_options[1]) ? $this->_options[1] : true;
		$trims = array(' ', '-', '_', '.', ',', '/', '|'); //znaki do usuniącia
		$tmp = strtoupper(str_replace($trims, '', $value));
		if (!isset($tmp[0])) {
			return $value;
		}
		if (is_numeric($tmp[0])) {
			$tmp = 'PL' . $tmp;
		}
		if (!$useSpaces) {
			return $tmp;
		}
		$value = '';
		for ($i = 0, $len = strlen($tmp); $i < $len; $i++) {
			if (($i % 4) == 0 && $i != 0) {
				$value .= ' ';
			}
			$value .= $tmp[$i];
		}
		return $value;
	}

}
