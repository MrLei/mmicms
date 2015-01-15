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
 * Mmi/View/Helper/Abstract.php
 * @category   Mmi
 * @package    Mmi_View
 * @subpackage Helper
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    1.0.0
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

/**
 * Abstrakcyjna klasa helpera widoku
 * @category   Mmi
 * @package    Mmi_View
 * @subpackage Helper
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */
class Mmi_View_Helper_Abstract {

	/**
	 * Referencja do widoku
	 * @var Mmi_View
	 */
	public $view;

	/**
	 * Metoda programisty końcowego, wykonuje się na końcu konstruktora
	 */
	public function init() {}

	/**
	 * Konstruktor, ustawia widok
	 */
	public function __construct() {
		$this->view = Mmi_Controller_Front::getInstance()->getView();
		$this->init();
	}

}
