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
 * Mmi/Controller/Action/Helper/HelperAbstract.php
 * @category   Mmi
 * @package    \Mmi\Controller
 * @subpackage Helper
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    1.0.0
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */
/**
 * Abstrakcyjna klasa helperów kontrolera akcji
 * @category   Mmi
 * @package    \Mmi\Controller
 * @subpackage Helper
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

namespace Mmi\Controller\Action\Helper;

class HelperAbstract {

	/**
	 * Request
	 * @var \Mmi\Controller\Request
	 */
	protected $_request;

	/**
	 * Inicjalizacja dla programisty
	 */
	public function init() {
		
	}

	/**
	 * Ustawia request (zastępujący domyślny z Front Controllera)
	 * @param \Mmi\Controller\Request $request
	 * @return \Mmi\Controller\Action\Helper\HelperAbstract
	 */
	public final function setRequest(\Mmi\Controller\Request $request) {
		$this->_request = $request;
		return $this;
	}

	/**
	 * Zwraca request
	 * @return \Mmi\Controller\Request
	 */
	public final function getRequest() {
		if (!$this->_request) {
			return \Mmi\Controller\Front::getInstance()->getRequest();
		}
		return $this->_request;
	}

}
