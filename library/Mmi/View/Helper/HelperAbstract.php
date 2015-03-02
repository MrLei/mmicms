<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Mmi\View\Helper;

class HelperAbstract {

	/**
	 * Referencja do widoku
	 * @var \Mmi\View
	 */
	public $view;

	/**
	 * Metoda programisty końcowego, wykonuje się na końcu konstruktora
	 */
	public function init() {
		
	}

	/**
	 * Konstruktor, ustawia widok
	 */
	public function __construct() {
		$this->view = \Mmi\Controller\Front::getInstance()->getView();
		$this->init();
	}

}
