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
 * Mmi/Controller/Action/Helper/Abstract.php
 * @category   Mmi
 * @package    Mmi_Controller
 * @subpackage Helper
 * @copyright  Copyright (c) 2010 HQSoft Mariusz Miłejko (http://www.hqsoft.pl)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    $Id$
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */

/**
 * Abstrakcyjna klasa helperów kontrolera akcji
 * @category   Mmi
 * @package    Mmi_Controller
 * @subpackage Helper
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */
class Mmi_Controller_Action_Helper_Abstract {

	/**
	 * Kontroler akcji
	 * @var Mmi_Controller_Action
	 */
	private $_actionController;
	
	/**
	 * Inicjalizacja dla programisty
	 */
	public function init() {}

	/**
	 * Magiczne pobranie zmiennej z requestu
	 * @param mixed $name wartość zmiennej
	 */
	public final function __get($name) {
		return $this->_getParam($name);
	}
	
	/**
	 * Ustawia kontroler akcji
	 * @param Mmi_Controller_Action $actionController
	 * @return Mmi_Controller_Action_Helper_Abstract 
	 */
	public final function setActionController(Mmi_Controller_Action $actionController) {
		$this->_actionController = $actionController;
		return $this;
	}
	
	/**
	 * Zwraca kontroler akcji
	 * @return Mmi_Controller_Action
	 */
	public final function getActionController() {
		return $this->_actionController;
	}
	
	/**
	 * Pobiera request
	 * @return Mmi_Controller_Request
	 */
	public final function getRequest() {
		return $this->_actionController->getRequest();
	}

	/**
	 * Pobiera parametr z requestu
	 * @param string $name nazwa parametru
	 * @return mixed wartość
	 */
	protected final function _getParam($name) {
		return $this->getRequest()->getParam($name);
	}
	
}
