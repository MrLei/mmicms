<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Mmi\Validate;

class Iban extends ValidateAbstract {

	/**
	 * Treść błędu
	 */
	const INVALID = 'Wprowadzona wartość nie jest poprawnym numerem IBAN';

	/**
	 * Treść błędu o złym kraju IBAN
	 */
	const INVALID_COUNTRY = 'IBAN pochodzi z niedozwolonego kraju';

	/**
	 * Walidacja IBAN (rachunek bankowy)
	 * @param mixed $value wartość
	 * @return boolean
	 */
	public function isValid($value) {
		$country = isset($this->_options[0]) ? $this->_options[0] : 'PL';
		$limitCountries = isset($this->_options[1]) ? $this->_options[1] : array();
		$trims = array(' ', '-', '_', '.', ',', '/', '|'); //znaki do usuniącia
		$tmp = strtoupper(str_replace($trims, '', $value));
		if (!isset($tmp[0])) {
			$this->_error(self::INVALID);
			return false;
		}
		if (is_numeric($tmp[0])) {
			$tmp = $country . $tmp;
		}
		$country = $tmp[0] . $tmp[1];
		if (is_array($limitCountries) && !empty($limitCountries)) {
			if (is_string($limitCountries) && strlen($limitCountries) == 2 && $country != strtoupper($limitCountries)) {
				$this->_error(self::INVALID_COUNTRY);
				return false;
			}
			$validCountry = false;
			if (is_array($limitCountries)) {
				foreach ($limitCountries as $cntry) {
					if ($cntry == $country) {
						$validCountry = true;
						break;
					}
				}
				if (!$validCountry) {
					$this->_error(self::INVALID_COUNTRY);
					return false;
				}
			}
		}
		$tmp = substr($tmp, 4) . substr($tmp, 0, 4);
		$tmp = str_replace(array(
			'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O',
			'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'
			), array(
			'10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22',
			'23', '24', '25', '26', '27', '28', '29', '30', '31', '32', '33', '34', '35'
			), $tmp);

		if (bcmod($tmp, 97) != 1) {
			$this->_error(self::INVALID);
			return false;
		}
		return true;
	}

}
