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
 * Mmi/Filter/StripTags.php
 * @category   Mmi
 * @package    Mmi_Filter
 * @copyright  Copyright (c) 2010 HQSoft Mariusz Miłejko (http://www.hqsoft.pl)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    $Id$
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */

/**
 * Filtr filtrujący zmienną, tak by mogła być wykorzystana wewnątrz właściwości znacznika HTML,
 * bez HTML i cudzysłowów
 * @category   Mmi
 * @package    Mmi_Filter
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */
class Mmi_Filter_MarkupProperty extends Mmi_Filter_Abstract {

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
