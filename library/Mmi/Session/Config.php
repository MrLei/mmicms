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
 * Mmi/Cache/Config.php
 * @category   Mmi
 * @package    Mmi_Session
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    1.0.0
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

/**
 * Konfiguracja sesji
 * @category   Mmi
 * @package    Mmi_Session
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

class Mmi_Session_Config {

	/**
	 * Nazwa sesji
	 * @var string
	 */
	public $name;

	/**
	 * Czas życia cookie w sekundach (0 - bez limitu)
	 * @var int
	 */
	public $cookieLifetime = 0;

	/**
	 * Czas wygasania cache w sekundach
	 * @var int
	 */
	public $cacheExpire = 14400;

	/**
	 * Mnożnik GC
	 * @var int
	 */
	public $gcDivisor = 1000;

	/**
	 * Czas życia GC
	 * @var int
	 */
	public $gcMaxLifetime = 28800;

	/**
	 * Prawdopodobnieństwo zadziałania GC
	 * @var int
	 */
	public $gcProbability = 1;

	/**
	 * Backend obsługujący sesje
	 * user | file | memcache
	 * @var string
	 */
	public $handler = 'user';

	/**
	 * Ścieżka zapisu sesji
	 * @var tmp
	 */
	public $path = 'apc';

	/**
	 * Model autoryzacyjny
	 * @var string
	 */
	public $authModel;

	/**
	 * Czas pamiętania użytkownika
	 * @var int
	 */
	public $authRemember = 31536000;

}