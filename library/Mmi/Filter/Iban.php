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
 * Mmi/Filter/Iban.php
 * @category   Mmi
 * @package    Mmi_Filter
 * @copyright  Copyright (c) 2010 HQSoft Mariusz Miłejko (http://www.hqsoft.pl)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    $Id$
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */

/**
 * Filtr poprawiający wygląd numerów IBAN
 * @category   Mmi
 * @package    Mmi_Filter
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */
class Mmi_Filter_Iban extends Mmi_Filter_Abstract {

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
