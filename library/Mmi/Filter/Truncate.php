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
 * Mmi/Filter/Truncate.php
 * @category   Mmi
 * @package    \Mmi\Filter
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    1.0.0
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */
/**
 * Filtr obcinający ciąg do zadanej długości
 * @category   Mmi
 * @package    \Mmi\Filter
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

namespace Mmi\Filter;

class Truncate extends \Mmi\Filter\FilterAbstract {

	/**
	 * Obcina ciąg do zadanej długości
	 * @param mixed $value wartość
	 * @throws Exception jeśli filtrowanie $value nie jest możliwe
	 * @return mixed
	 */
	public function filter($value) {
		$length = isset($this->_options[0]) ? (int) $this->_options[0] : 80;

		if (strlen($value) < $length) {
			return $value;
		}

		$end = isset($this->_options[1]) ? $this->_options[1] : '...';
		$boundary = isset($this->_options[2]) ? (bool) $this->_options[2] : false;
		$encoding = mb_detect_encoding($value);
		if ($boundary) {
			$value = mb_substr($value, 0, $length, $encoding) . $end;
		} else {
			$value = mb_substr($value, 0, $length + 1, $encoding);
			if (strrpos($value, ' ') !== false) {
				$value = mb_substr($value, 0, strrpos($value, ' '), $encoding);
			}
			$value .= '...';
		}

		return $value;
	}

}
