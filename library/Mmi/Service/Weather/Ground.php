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
 * Mmi/Service/Weather/Ground.php
 * @category   Mmi
 * @package    Mmi_Service
 * @copyright  Copyright (c) 2012 HQSoft Mariusz Miłejko (http://www.hqsoft.pl)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    $Id$
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */

/**
 * Klasa implementująca obsługę API WeatherGround.com
 * @category   Mmi
 * @package    Mmi_Service
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */
class Mmi_Service_Weather_Ground extends Mmi_Service_Weather_Abstract {

	/**
	 * Konstruktor wymaga podania klucza API
	 * @param string $apiKey klucz api
	 */
	public function __construct($apiKey) {
		$this->_url = 'http://api.wunderground.com/api/' . $apiKey;
	}
	
	public function search($placeName) {
		$current = json_decode(file_get_contents($this->_url . '/conditions/forecast/q/' . urlencode($placeName) . '.json'));
		if (!isset($current->current_observation)) {
			throw new Exception('No data');
		}
		$current = $current->current_observation;
		$wd = new Mmi_Service_Weather_Data();
		$wd->temperature = $current->temp_c;
		$wd->humidity = trim($current->relative_humidity, '%');
		$wd->windSpeed = $current->wind_kph;
		$wd->windDirection = $current->wind_dir[0];
		$wd->icon = $current->icon_url;
		$wd->condition = $current->weather;
		return $wd;
	}
	
}