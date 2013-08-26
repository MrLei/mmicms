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
 * Mmi/Controller/Plugin/Abstract.php
 * @category   Mmi
 * @package    Mmi_Controller
 * @subpackage Plugin
 * @copyright  Copyright (c) 2010 HQSoft Mariusz Miłejko (http://www.hqsoft.pl)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    $Id$
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */

/**
 * Abstrakcyjna klasa pluginów do front kontrolera
 * @category   Mmi
 * @package    Mmi_Controller
 * @subpackage Plugin
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */
class Mmi_Controller_Plugin_Abstract {

	/**
	 * Metoda wykona się przed routingiem
	 * @param Mmi_Controller_Request $request 
	 */
	public function routeStartup(Mmi_Controller_Request $request) {
		
	}

	/**
	 * Metoda wykona się przed dispatchowaniem
	 * @param Mmi_Controller_Request $request
	 */
	public function preDispatch(Mmi_Controller_Request $request) {
		
	}

	/**
	 * Metoda wykona się po dispatchowaniu
	 * @param Mmi_Controller_Request $request
	 */
	public function postDispatch(Mmi_Controller_Request $request) {
		
	}

}
