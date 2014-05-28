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
 * Mmi/Filter/Intval.php
 * @category   Mmi
 * @package    Mmi_Filter
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    1.0.0
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

/**
 * Filtr wycinający wszystko poza liczbami
 * @category   Mmi
 * @package    Mmi_Filter
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */
class Mmi_Filter_Intval extends Mmi_Filter_Abstract {

	/**
	 * Wycina wszystko poza liczbami
	 * @param mixed $value wartość
	 * @throws Exception jeśli filtrowanie $value nie jest możliwe
	 * @return mixed
	 */
	public function filter($value) {
		return intval($value);
	}

}
