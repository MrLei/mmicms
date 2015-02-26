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
 * Mmi/Db.php
 * @category   Mmi
 * @package    \Mmi\Db
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    1.0.0
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */
/**
 * Klasa fabryki adapterów bazodanowych
 * @category   Mmi
 * @package    \Mmi\Db
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

namespace Mmi;

class Db {

	/**
	 * Tworzy obiekty adaptera na podstawie opcji
	 * @param \Mmi\Db\Config $config
	 * @return \Mmi\Db\Adapter\Pdo\Abstract
	 */
	public static function factory(\Mmi\Db\Config $config) {
		if ($config->driver != 'mysql' && $config->driver != 'pgsql' && $config->driver != 'sqlite' && $config->driver != 'oci') {
			throw new \Exception('\Mmi\Db driver not supplied');
		}
		$driver = '\\Mmi\\Db\\Adapter\\Pdo\\' . ucfirst($config->driver);
		return new $driver($config);
	}

}
