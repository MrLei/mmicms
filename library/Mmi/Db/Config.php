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
 * Mmi/Db/Config.php
 * @category   Mmi
 * @package    Mmi_Db
 * @copyright  Copyright (c) 2010 HQSoft Mariusz Miłejko (http://www.hqsoft.pl)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    $Id$
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */

/**
 * Konfiguracja bazy danych
 * @category   Mmi
 * @package    Mmi_Db
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */

class Mmi_Db_Config {

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
	public $charset = 'utf-8';

	/**
	 * Połączenie trwałe
	 * @var boolean
	 */
	public $persistent = false;

}