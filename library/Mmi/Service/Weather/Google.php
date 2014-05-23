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
 * Mmi/Service/Weather/Google.php
 * @category   Mmi
 * @package    Mmi_Service
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    1.0.0
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

/**
 * Klasa implementująca obsługę API Google Weather
 * @category   Mmi
 * @package    Mmi_Service
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */
class Mmi_Service_Weather_Google extends Mmi_Service_Weather_Abstract {
	
	/**
	 * Ścieżka bazowa do ikon
	 * @var string
	 */
	protected $_iconBaseUrl = 'http://www.google.com';

	/**
	 * Konstruktor, ustawienie url usługi
	 */
	public function __construct() {
		$this->_url = 'http://www.google.com/ig/api?weather';
	}
	
	/**
	 * Wyszukanie po nazwie miejsca
	 * @param string $placeName nazwa miejsca (np. kraj+miasto)
	 * @return Mmi_Service_Weather_Data aktualna pogoda
	 */
	public function search($placeName) {
		$xml = new SimpleXMLElement(preg_replace('/<(city|postal_code) data="(.[^>]+)"\/>/', '<$1 data=""/>', file_get_contents($this->_url . '=' . urlencode($placeName))));
		$wd = new Mmi_Service_Weather_Data();
		
		$current = $xml->weather->current_conditions;
		if (!isset($xml->weather->current_conditions)) {
			throw new Exception('No data');
		}
		$current = $xml->weather->current_conditions;
		$wd->condition = (string)$current->condition->attributes()->data;
		$wd->temperature = (string)$current->temp_c->attributes()->data;
		$wd->humidity = (string)$current->humidity->attributes()->data;
		$wd->humidity = substr($wd->humidity, 10, -1);
		$wd->icon = $this->_iconBaseUrl . (string)$current->icon->attributes()->data;
		
		if (isset($current->wind_condition)) {
			$wind = (string)$current->wind_condition->attributes()->data;
			$wind = substr($wind, 6);
			$wd->windDirection = trim(substr($wind, 0, 2));
			$windMph = trim(substr($wind, 5, -4));
			$wd->windSpeed = round($windMph * 1.609);
		}
		
		$current = $wd;
		$this->_forecast = array();
		foreach ($xml->weather->forecast_conditions as $forecast) {
			$wd = new Mmi_Service_Weather_Data();
			$wd->condition = (string)$forecast->condition->attributes()->data;
			$minFahrenheit = (string)$forecast->low->attributes()->data;
			$maxFahrenheit = (string)$forecast->high->attributes()->data;
			$minCelsius = ($minFahrenheit - 32) * 5/9;
			$maxCelsius = ($maxFahrenheit - 32) * 5/9;
			$wd->temperature = round(($minCelsius + $maxCelsius) / 2); 
			$wd->icon = $this->_iconBaseUrl . (string)$forecast->icon->attributes()->data;
			$this->_forecast[] = $wd;
		}
		return $current;
	}

}