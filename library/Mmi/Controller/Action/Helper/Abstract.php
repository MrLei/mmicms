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
 * Mmi/Controller/Action/Helper/Abstract.php
 * @category   Mmi
 * @package    Mmi_Controller
 * @subpackage Helper
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    1.0.0
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

/**
 * Abstrakcyjna klasa helperów kontrolera akcji
 * @category   Mmi
 * @package    Mmi_Controller
 * @subpackage Helper
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */
class Mmi_Controller_Action_Helper_Abstract {

	/**
	 * Request
	 * @var Mmi_Controller_Request
	 */
	protected $_request;

	/**
	 * Inicjalizacja dla programisty
	 */
	public function init() {
		
	}

	/**
	 * Ustawia request (zastępujący domyślny z Front Controllera)
	 * @param Mmi_Controller_Request $request
	 * @return Mmi_Controller_Action_Helper_Abstract
	 */
	public final function setRequest(Mmi_Controller_Request $request) {
		$this->_request = $request;
		return $this;
	}

	/**
	 * Zwraca request
	 * @return Mmi_Controller_Request
	 */
	public final function getRequest() {
		if (!$this->_request) {
			return Mmi_Controller_Front::getInstance()->getRequest();
		}
		return $this->_request;
	}

}
