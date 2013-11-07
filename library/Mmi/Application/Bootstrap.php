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
 * Mmi/Application/Bootstrap.php
 * @category   Mmi
 * @package    Mmi_Application
 * @copyright  Copyright (c) 2010 HQSoft Mariusz Miłejko (http://www.hqsoft.pl)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    $Id$
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */

/**
 * Prosty bootstrap wczytujący strukturę aplikacji
 * @category   Mmi
 * @package    Mmi_Application
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */
class Mmi_Application_Bootstrap {

	/**
	 * Konstruktor
	 */
	public function __construct() {
		Mmi_Controller_Front::getInstance()->setStructure(Mmi_Structure::getStructure());
	}

	/**
	 * Uruchamianie front-kontrolera
	 */
	public function run() {
		Mmi_Controller_Front::getInstance()->dispatch();
	}

}
