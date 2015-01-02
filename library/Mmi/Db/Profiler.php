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
 * Mmi/Db/Adapter/Profiler.php
 * @category   Mmi
 * @package    Mmi_Db
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    1.0.0
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

/**
 * Klasa profilera bazodanowego
 * @category   Mmi
 * @package    Mmi_Db
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */
class Mmi_Db_Profiler extends Mmi_Profiler {

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
	 * Event query
	 * @param PDOStatement $statement
	 * @param array $bind
	 * @param float $elapsed
	 */
	public static function eventQuery(PDOStatement $statement, array $bind, $elapsed = null) {
		if (!static::$_enabled) {
			return;
		}
		$keys = array_keys($bind);
		//likwidacja dwukropków
		$keys[] = ':';
		$values = array_values($bind);
		array_walk($values, function (&$v) {
			$v = '\'' . $v . '\'';
		});
		return parent::event(str_replace($keys, $values, $statement->queryString), $elapsed);
	}

}
