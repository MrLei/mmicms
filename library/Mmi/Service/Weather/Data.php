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
 * Mmi/Service/Weather/Data.php
 * @category   Mmi
 * @package    Mmi_Service
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    1.0.0
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

/**
 * Klasa implementująca obiekt pogody (dane)
 * @category   Mmi
 * @package    Mmi_Service
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */
class Mmi_Service_Weather_Data {
	
	/**
	 * Warunki
	 * @var string
	 */
	public $condition;
	
	/**
	 * Temperatura celsjusz
	 * @var int
	 */
	public $temperature;
	
	/**
	 * Wilgotność procentowa
	 * @var int
	 */
	public $humidity;
	
	/**
	 * Prędkość wiatru Km/h
	 * @var int
	 */
	public $windSpeed;
	
	/**
	 * Kierunek wiatru
	 * @var string
	 */
	public $windDirection;
	
	/**
	 * Odczuwalna temperatura
	 * @var int
	 */
	public $windChill;
	
	/**
	 * Pressure
	 * @var int
	 */
	public $pressure;

	/**
	 * Wschód słońca
	 * @var string
	 */
	public $sunrise;

	/**
	 * Zachód słońca
	 * @var string
	 */
	public $sunset;

	/**
	 * Ikona
	 * @var string 
	 */
	public $icon;
	
	/**
	 * Zwraca wszystkie dane obiektu w formie tablicy
	 * @return array
	 */
	public function toArray() {
		return array(
			'condition' => $this->condition,
			'temperature' => $this->temperature,
			'humidity' => $this->humidity,
			'windSpeed' => $this->windSpeed,
			'windDirection' => $this->windDirection,
			'windChill' => $this->windChill,
			'sunrise' => $this->sunrise,
			'sunset' => $this->sunset,
			'pressure' => $this->pressure,
			'icon' => $this->icon
		);
	}
	
}