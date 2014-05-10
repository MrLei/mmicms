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
 * Mmi/Validate/LargeSmall.php
 * @category   Mmi
 * @package    Mmi_Validate
 * @copyright  Copyright (c) 2010 HQSoft Mariusz Miłejko (http://www.hqsoft.pl)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    $Id$
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */

/**
 * Klasa walidacji ciągu na podstawie stosunku ilości wielkich do małych liter
 * @category   Mmi
 * @package    Mmi_Validate
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */
class Mmi_Validate_LargeSmall extends Mmi_Validate_Abstract {

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