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
 * Mmi/Service/Weather/Abstract.php
 * @category   Mmi
 * @package    Mmi_Service
 * @copyright  Copyright (c) 2012 HQSoft Mariusz Miłejko (http://www.hqsoft.pl)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    $Id$
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */

/**
 * Klasa abstrakcyjna obsługi API dostawców pogody
 * @category   Mmi
 * @package    Mmi_Service
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */
abstract class Mmi_Service_Weather_Abstract {

	/**
	 * Link do api
	 * @var string
	 */
	protected $_url;
	
	/**
	 * Tablica z obiektami pogody - prognoza
	 * @var array
	 */
	protected $_forecast = array();
	
	/**
	 * Wyszukanie po nazwie miejsca
	 * @param string $placeName nazwa miejsca (np. kraj+miasto)
	 * @return Mmi_Service_Weather_Data aktualna pogoda
	 */
	abstract public function search($placeName);

	/**
	 * Pobiera dane prognozowane po wyszukaniu
	 * przed wyszukaniem wyrzuca wyjątek
	 * @return array()
	 * @throws Exception 
	 */
	public function getForecast() {
		if (empty($this->_forecast)) {
			throw new Exception('No data');
		}
		return $this->_forecast;
	}
	
}