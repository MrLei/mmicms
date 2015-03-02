<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Mmi\Service\Weather;

abstract class WeatherAbstract {

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
	 * @return \Mmi\Service\Weather\Data aktualna pogoda
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
			throw new\Exception('No data');
		}
		return $this->_forecast;
	}

}
