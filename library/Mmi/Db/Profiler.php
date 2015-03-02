<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Mmi\Db;

class Profiler extends \Mmi\Profiler {

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
	public static function eventQuery(\PDOStatement $statement, array $bind, $elapsed = null) {
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
