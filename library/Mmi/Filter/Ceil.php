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
 * Mmi/Filter/Ceil.php
 * @category   Mmi
 * @package    Mmi_Filter
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    1.0.0
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

/**
 * Filtr zaokrąglający do góry
 * @category   Mmi
 * @package    Mmi_Filter
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */
class Mmi_Filter_Ceil extends Mmi_Filter_Abstract {

	/**
	 * Zaokrągla liczby
	 * @param mixed $value wartość
	 * @throws Exception jeśli filtrowanie $value nie jest możliwe
	 * @return mixed
	 */
	public function filter($value) {
		return ceil($value);
	}

}
