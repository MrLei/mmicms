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
 * Mmi/Validate/LargeSmall.php
 * @category   Mmi
 * @package    \Mmi\Validate
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    1.0.0
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */
/**
 * Klasa walidacji ciągu na podstawie stosunku ilości wielkich do małych liter
 * @category   Mmi
 * @package    \Mmi\Validate
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

namespace Mmi\Validate;

class LargeSmall extends ValidateAbstract {

	/**
	 * Komunikat o zbyt dużej ilości wielkich liter
	 */
	const INVALID = 'Tekst zawiera zbyt dużo wielkich liter';

	/**
	 * Waliduje zawartość wielkich liter, ilość procent zadana jest w opcjach (przy konstruktorze)
	 * w tabeli postaci array(procent)
	 * @param string $value
	 * @return boolean
	 */
	public function isValid($value) {
		if (strlen($value) == 0) {
			return;
		}
		$percent = isset($this->_options[0]) ? $this->_options[0] : 40;
		$percent = $percent / 100;
		$largeCount = 0;
		if (mb_detect_encoding($value) != '') {
			$upper = mb_strtoupper($value, mb_detect_encoding($value));
		} else {
			$upper = strtoupper($value);
		}
		for ($i = 0, $len = strlen($value); $i < $len; $i++) {
			if (isset($value[$i]) && isset($upper[$i]) && !is_numeric($value[$i]) &&
				$value[$i] != ' ' &&
				$value[$i] != '.' &&
				$value[$i] != ',' &&
				$value[$i] != '!' &&
				$value[$i] != '?' &&
				$value[$i] != '@' &&
				$value[$i] != '%' &&
				$value[$i] != '&' &&
				$value[$i] != '(' &&
				$value[$i] != ')' &&
				$value[$i] != ']' &&
				$value[$i] != '[' &&
				$value[$i] != ':' &&
				$value[$i] != ';' &&
				$value[$i] != '/' &&
				$value[$i] != '+' &&
				$value[$i] != '-' &&
				$value[$i] != '`' &&
				$value[$i] != '$' &&
				$upper[$i] == $value[$i]) {
				$largeCount++;
			}
		}
		if (($largeCount / $len) > $percent) {
			$this->_error(self::INVALID);
			return false;
		}
		return true;
	}

}
