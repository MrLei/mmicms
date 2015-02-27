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
 * Mmi/Filter/EmptyToNull.php
 * @category   Mmi
 * @package    \Mmi\Filter
 * @copyright  Copyright (c) 2011 HQSoft Mariusz Miłejko (http://www.hqsoft.pl)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    1.0.0
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */
/**
 * Filtr zamieniający pusty ciąg znaków na null
 * @category   Mmi
 * @package    \Mmi\Filter
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

namespace Mmi\Filter;

class EmptyToNull extends \Mmi\Filter\FilterAbstract {

	/**
	 * Zamienia pusty ciąg znaków na null
	 * @param mixed $value wartość
	 * @throws Exception jeśli filtrowanie $value nie jest możliwe
	 * @return mixed
	 */
	public function filter($value) {
		return ($value == '') ? null : $value;
	}

}
