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
 * Mmi/Service/Weather/Abstract.php
 * @category   Mmi
 * @package    Mmi_Service
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    1.0.0
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

/**
 * Klasa abstrakcyjna obsługi API dostawców pogody
 * @category   Mmi
 * @package    Mmi_Service
 * @license    http://milejko.com/new-bsd.txt     New BSD License
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