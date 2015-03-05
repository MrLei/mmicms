<?php

/**
 * Mmi Framework (https://code.google.com/p/mmicms/)
 * 
 * @link       https://code.google.com/p/mmicms/
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @license    http://milejko.com/new-bsd.txt New BSD License
 */

namespace Mmi\Form\Element;

class Select extends ElementAbstract {

	/**
	 * Ustawia multiselect
	 * @return \Mmi\Form\Element\Select
	 */
	public function setMultiple() {
		$this->_options['multiple'] = 'multiple';
		return $this;
	}

	/**
	 * Zwraca czy pole jest multiple
	 * @return boolean
	 */
	public final function isMultiple() {
		return (isset($this->_options['multiple']) && $this->_options['multiple'] === 'multiple') ? true : false;
	}

	/**
	 * Buduje pole
	 * @return string
	 */
	public function fetchField() {
		$multiOptions = (isset($this->_options['multiOptions']) && is_array($this->_options['multiOptions'])) ? $this->_options['multiOptions'] : array();
		$value = $this->getValue();
		if (isset($this->_options['multiple'])) {
			$this->_options['name'] = $this->_options['name'] . '[]';
		}
		unset($this->_options['value']);
		$html = '<select ' . $this->_getHtmlOptions() . '>';
		foreach ($multiOptions as $key => $caption) {
			$disabled = '';
			if (strpos($key, ':disabled') !== false && !is_array($caption)) {
				$key = '';
				$disabled = ' disabled="disabled"';
			}
			if (strpos($key, ':divide') !== false && !is_array($caption)) {
				$html .= '<option disabled="disabled" class="divide">' . $caption . '</option>';
				continue;
			}
			if (is_array($caption)) {
				$html .= '<optgroup label="' . $key . '">';
				foreach ($caption as $k => $c) {
					$html .= '<option value="' . $k . '" ' . $this->_calculateSelected($k, $value) . $disabled . '>' . $c . '</option>';
				}
				$html .= '</optgroup>';
				continue;
			}
			$html .= '<option value="' . $key . '"' . $this->_calculateSelected($key, $value) . $disabled . '>' . $caption . '</option>';
		}
		$html .= '</select>';
		return $html;
	}

	/**
	 * Zaznacza element który powinien być zaznaczony
	 * @param string $key klucz
	 * @param string $value wartość
	 * @return string
	 */
	protected function _calculateSelected($key, $value) {
		$selected = ' selected="selected"';
		//typ tablicowy
		if (is_array($value) && in_array($key, $value)) {
			return $selected;
		}
		//typ skalarny
		if ((string)$value == (string)$key && !is_null($value)) {
			return $selected;
		}
		return '';
	}

}
