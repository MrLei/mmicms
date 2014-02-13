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
 * Mmi/Filter/Truncate.php
 * @category   Mmi
 * @package    Mmi_Filter
 * @copyright  Copyright (c) 2010 HQSoft Mariusz Miłejko (http://www.hqsoft.pl)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    $Id$
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */

/**
 * Filtr obcinający ciąg do zadanej długości
 * @category   Mmi
 * @package    Mmi_Filter
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */
class Mmi_Filter_Truncate extends Mmi_Filter_Abstract {

	/**
	 * Obcina ciąg do zadanej długości
	 * @param mixed $value wartość
	 * @throws Exception jeśli filtrowanie $value nie jest możliwe
	 * @return mixed
	 */
	public function filter($value) {
		$length = isset($this->_options[0]) ? (int)$this->_options[0] : 80;

		if (strlen($value) < $length) {
			return $value;
		}

		$end = isset($this->_options[1]) ? $this->_options[1] : '...';
		$boundary = isset($this->_options[2]) ? (bool)$this->_options[2] : false;
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
