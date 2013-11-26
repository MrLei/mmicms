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
	 * Profiler włączony
	 * @var boolean
	 */
	protected static $_enabled = true;

	/**
	 * Dodaje zdarzenie
	 * @param string $name nazwa
	 * @param string $elapsed opcjonalnie czas operacji
	 */
	public static function event($name, $elapsed = null) {
		if (!static::$_enabled) {
			return;
		}
		$time = microtime(true);
		if ($elapsed === null && static::$_counter > 0) {
			$elapsed = $time - static::$_data[static::$_counter - 1]['time'];
		} elseif ($elapsed === null) {
			$elapsed = 0;
		}
		static::$_data[static::$_counter] = array(
			'name' => $name,
			'time' => $time,
			'elapsed' => $elapsed,
		);
		static::$_elapsed += $elapsed;
		static::$_counter++;
	}

	/**
	 * Włącza profiler
	 * @param boolean $enabled
	 * @return boolean
	 */
	public static final function setEnabled($enabled = true) {
		return (static::$_enabled = $enabled);
	}

	/**
	 * Pobiera dane z profilera
	 * @return array
	 */
	public static final function get() {
		if (static::$_elapsed == 0) {
			return static::$_data;
		}
		foreach (static::$_data as $key => $item) {
			static::$_data[$key]['percent'] = 100 * $item['elapsed'] / static::$_elapsed;
		}
		return static::$_data;
	}

	/**
	 * Zwraca ilość zdarzeń w profilerze
	 * @return int
	 */
	public static final function count() {
		return static::$_counter;
	}

	/**
	 * Pobiera sumaryczny czas wszystkich zdarzeń
	 * @return int
	 */
	public static final function elapsed() {
		return static::$_elapsed;
	}

}