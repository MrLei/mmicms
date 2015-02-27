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
 * Mmi/Filter/StripTags.php
 * @category   Mmi
 * @package    \Mmi\Filter
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    1.0.0
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */
/**
 * Filtr filtrujący zmienną, tak by mogła być wykorzystana wewnątrz właściwości znacznika HTML
 * bez HTML i cudzysłowów
 * @category   Mmi
 * @package    \Mmi\Filter
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

namespace Mmi\Filter;

class MarkupProperty extends \Mmi\Filter\FilterAbstract {

	/**
	 * Zmienia zmienną, tak by mogła być wykorzystana wewnątrz właściwości znacznika HTML
	 * @param mixed $value wartość
	 * @throws Exception jeśli filtrowanie $value nie jest możliwe
	 * @return mixed
	 */
	public function filter($value) {
		$value = trim(strip_tags($value));

		$value = str_replace(array(
			'\'',
			'`',
			',',
			'"',
			'#',
			'?',
			'=',
			), array(
			'',
			'',
			'',
			'',
			'',
			'',
			'',
			), $value);
		return $value;
	}

}
