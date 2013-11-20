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
 * Mmi/Cache/Config.php
 * @category   Mmi
 * @package    Mmi_Cache
 * @copyright  Copyright (c) 2010 HQSoft Mariusz Miłejko (http://www.hqsoft.pl)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    $Id$
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */

/**
 * Konfiguracja cache
 * @category   Mmi
 * @package    Mmi_Cache
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */

class Mmi_Cache_Config {

	/**
	 * Buforowanie włączone
	 * @var boolean
	 */
	public $active = false;

	/**
	 * Czas życia bufora
	 * @var int
	 */
	public $lifetime = 300;

	/**
	 * Nazwa backendu obsługującego bufor:
	 * apc | file | memcache
	 * @var string
	 */
	public $handler = 'apc';

	/**
	 * Ścieżka dla handlerów plikowych i memcache
	 * @var string
	 */
	public $path;

}