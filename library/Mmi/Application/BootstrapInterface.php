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
 * Mmi/Application/Bootstrap/Interface.php
 * @category   Mmi
 * @package    \Mmi\Application
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    1.0.0
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */
/**
 * Interface bootstrapów aplikacji
 * @category   Mmi
 * @package    \Mmi\Application
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

namespace Mmi\Application;

interface BootstrapInterface {

	/**
	 * Parametryzowanie bootstrapa
	 */
	public function __construct();

	/**
	 * Uruchomienie bootstrapa
	 */
	public function run();
}
