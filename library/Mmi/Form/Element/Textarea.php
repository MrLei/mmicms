<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Mmi\Form\Element;

class Textarea extends ElementAbstract {

	/**
	 * Funkcja użytkownika, jest wykonywana na końcu konstruktora
	 */
	public function init() {
		if (!isset($this->_options['rows'])) {
			$this->_options['rows'] = 10;
		}
		if (!isset($this->_options['cols'])) {
			$this->_options['cols'] = 60;
		}
	}

	/**
	 * Buduje pole
	 * @return string
	 */
	public function fetchField() {
		$value = isset($this->_options['value']) ? $this->_options['value'] : null;
		$filter = $this->_getFilter('Input');
		$value = $filter->filter($value);
		unset($this->_options['value']);
		$html = '<textarea ' . $this->_getHtmlOptions() . '>' . $value . '</textarea>';
		return $html;
	}

}
