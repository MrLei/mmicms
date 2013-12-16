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
class Mmi_Filter_DiffHourFilter extends Mmi_Filter_Abstract {

	/**
	 * Przyjmuje string w postaci dwóch czasów z których wylicza różnicę
	 */
	public function filter($value) {
		$arrayHour = explode(';', $value);
		$startHour = new DateTime($arrayHour[0]);
		$endHour = new DateTime($arrayHour[1]);
		$diffTime = $endHour->getTimestamp() - $startHour->getTimestamp();
		$timeOfChange = new DateTime();
		$timeOfChange->setTimezone(new DateTimeZone('GMT'));
		$timeOfChange->setTimestamp($diffTime);

		return $timeOfChange->format('H:i');
	}

}
