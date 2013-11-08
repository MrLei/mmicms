<?php

/**
 * MmiCms
 *
 * LICENSE
 *
 * Ten plik źródłowy objęty jest licencją BSD bez klauzuli ogłoszeniowej.
 * Licencja jest dostępna pod adresem: http://www.hqsoft.pl/new-bsd
 * W przypadku problemów, prosimy o kontakt na adres office@hqsoft.pl
 *
 * MmiCms/Bootstrap/Cmd.php
 * @category   MmiCms
 * @package    MmiCms_Bootstrap
 * @copyright  Copyright (c) 2010 HQSoft Mariusz Miłejko (http://www.hqsoft.pl)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    $Id$
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */

/**
 * Klasa startu aplikacji command line
 * ustawia ścieżki, ładuje ogólną konfigurację
 * @category   Mmi
 * @package    Mmi_Bootstrap
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */
class MmiCms_Application_Bootstrap_Commandline extends MmiCms_Application_Bootstrap {

	/**
	 * Uruchamianie front-kontrolera (brak front kontrolera)
	 */
	public function run() {
		$front = Mmi_Controller_Front::getInstance();
		//$front->routeStartup();
		//$front->preDispatch();
		//$front->postDispatch();
	}

}