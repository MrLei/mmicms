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
 * Mmi/Db/Config.php
 * @category   Mmi
 * @package    \Mmi\Db
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    1.0.0
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */
/**
 * Konfiguracja bazy danych
 * @category   Mmi
 * @package    \Mmi\Db
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

namespace Mmi\Db;

class Config {

	/**
	 * Silnik bazy danych
	 * pgsql | mysql | sqlite
	 * @var string
	 */
	public $driver;

	/**
	 * Host bazy danych (lub ścieżka sqlite)
	 * @var string
	 */
	public $host;

	/**
	 * Port bazy danych
	 * @var int
	 */
	public $port;

	/**
	 * Nazwa bazy
	 * @var string
	 */
	public $name;

	/**
	 * Schemat
	 * @var string
	 */
	public $schema;

	/**
	 * Nazwa użytkownika
	 * @var string
	 */
	public $user;

	/**
	 * Hasło
	 * @var string
	 */
	public $password;

	/**
	 * Kodowanie znaków
	 * @var string
	 */
	public $charset = 'utf8';

	/**
	 * Połączenie trwałe
	 * @var boolean
	 */
	public $persistent = false;

	/**
	 * Profiler włączony
	 * @var boolean
	 */
	public $profiler = false;

}
