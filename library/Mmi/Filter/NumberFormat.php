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
 * Mmi/Filter/NumberFormat.php
 * @category   Mmi
 * @package    Mmi_Filter
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    1.0.0
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

/**
 * Klasa filtracji zmiennych numerycznych
 * @category   Mmi
 * @package    Mmi_Filter
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */
class Mmi_Filter_NumberFormat extends Mmi_Filter_Abstract {

	/**
	 * Filtruje zmienne numeryczne
	 * @param mixed $value wartość
	 * @throws Exception jeśli filtrowanie $value nie jest możliwe
	 * @return mixed
	 */
	public function filter($value) {
		$digits = isset($this->_options[0]) ? $this->_options[0] : 2;
		$separator = isset($this->_options[1]) ? $this->_options[1] : ',';
		$thousands = isset($this->_options[2]) ? $this->_options[2] : ' ';
		$trimZeros = isset($this->_options[3]) ? $this->_options[3] : false;
		$trimLeaveZeros = isset($this->_options[4]) ? $this->_options[4] : 2;
		$value = number_format($value, $digits, $separator, $thousands);
		if ($trimZeros && strpos($value, $separator)) {
			$tmp = rtrim($value, '0');
			for ($i = 0, $missing = $trimLeaveZeros - ($digits - (strlen($value) - strlen($tmp))); $i < $missing; $i++) {
				$tmp .= '0';
			}
			$value = rtrim($tmp, '.,');
		}
		return str_replace('-', '- ', $value);
	}

}
