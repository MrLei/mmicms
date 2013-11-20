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
 * Mmi/Application/Bootstrap/Interface.php
 * @category   Mmi
 * @package    Mmi_Application
 * @copyright  Copyright (c) 2010 HQSoft Mariusz Miłejko (http://www.hqsoft.pl)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    $Id$
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */

/**
 * Interface bootstrapów aplikacji
 * @category   Mmi
 * @package    Mmi_Application
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */
interface Mmi_Application_Bootstrap_Interface {

	/**
	 * Parametryzowanie bootstrapa
	 */
	public function __construct();

	/**
	 * Uruchomienie bootstrapa
	 */
	public function run();

}
