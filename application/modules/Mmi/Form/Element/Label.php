<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Mmi\Form\Element;

class Label extends ElementAbstract {

	/**
	 * Funkcja użytkownika, jest wykonywana na końcu konstruktora
	 */
	public function init() {
		$this->_options['labelPostfix'] = '';
	}

	/**
	 * Buduje pole
	 * @return string
	 */
	public function fetchField() {
		return '';
	}

}
