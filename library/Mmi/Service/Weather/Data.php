<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Mmi\Service\Weather;

class Data {

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
