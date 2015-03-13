<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
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
