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
 * Mmi/Profiler.php
 * @category   Mmi
 * @package    Mmi_Profiler
 * @copyright  Copyright (c) 2010 HQSoft Mariusz Miłejko (http://www.hqsoft.pl)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    $Id$
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */

/**
 * Klasa profilowania aplikacji
 * profile można zobaczyć przy użyciu Mmi_View_Helper_Panel
 * @see        Mmi_View_Helper_Panel
 * @category   Mmi
 * @package    Mmi_Profiler
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */
class Mmi_Profiler {

	/**
	 * Dane profilera
	 * @var array
	 */
	protected static $_data = array();

	/**
	 * Licznik
	 * @var int
	 */
	protected static $_counter = 0;

	/**
	 * Licznik czasu
	 * @var int
	 */
	protected static $_elapsed = 0;

	/**
	 * Dodaje zdarzenie
	 * @param string $name nazwa
	 * @return null
	 */
	public static function event($name) {
		if (!isset(Mmi_Config::$data['global']['debug']) || !Mmi_Config::$data['global']['debug']) {
			return;
		}
		$time = microtime(true);
		if (self::$_counter > 0) {
			$elapsed = $time - self::$_data[self::$_counter-1]['time'];
		} else {
			$elapsed = 0;
		}
		self::$_data[self::$_counter] = array(
			'name' => $name,
			'time' => $time,
			'elapsed' => $elapsed,
		);
		self::$_elapsed += $elapsed;
		self::$_counter++;
	}

	/**
	 * Pobiera dane z profilera
	 * @return array
	 */
	public static function get() {
		foreach (self::$_data as $key => $item) {
			self::$_data[$key]['percent'] = 100 * $item['elapsed'] / self::$_elapsed;
		}
		return self::$_data;
	}

	/**
	 * Pobiera sumaryczny czas wszystkich zdarzeń
	 * @return int
	 */
	public static function getElapsed() {
		return self::$_elapsed;
	}

}