<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
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
