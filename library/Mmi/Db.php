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
 * Mmi/Db.php
 * @category   Mmi
 * @package    Mmi_Db
 * @copyright  Copyright (c) 2010 HQSoft Mariusz Miłejko (http://www.hqsoft.pl)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    $Id$
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */

/**
 * Klasa fabryki adapterów bazodanowych
 * @category   Mmi
 * @package    Mmi_Db
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */
class Mmi_Db {

	/**
	 * Tworzy obiekty adaptera na podstawie opcji
	 * @param array $options
	 * @return driver
	 */
	public static function factory(array $options = array()) {
		if (!isset($options['driver'])) {
			throw new Exception('Driver not supplied');
		}
		$driver = 'Mmi_Db_Adapter_Pdo_' . ucfirst($options['driver']);
		return new $driver($options);
	}

}
