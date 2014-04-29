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
 * Mmi/Db/Adapter/Profiler.php
 * @category   Mmi
 * @package    Mmi_Db
 * @copyright  Copyright (c) 2010 HQSoft Mariusz Miłejko (http://www.hqsoft.pl)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    $Id$
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */

/**
 * Klasa profilera bazodanowego
 * @category   Mmi
 * @package    Mmi_Db
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
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

}
