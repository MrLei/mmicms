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
 * @package    \Mmi\Cache
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    1.0.0
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */
/**
 * Konfiguracja cache
 * @category   Mmi
 * @package    \Mmi\Cache
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

namespace Mmi\Cache;

class Config {

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
