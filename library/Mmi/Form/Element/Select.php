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
 * Mmi/Form/Element/Select.php
 * @category   Mmi
 * @package    Mmi_Form
 * @subpackage Element
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    1.0.0
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

/**
 * Klasa elementu opcji (select)
 * @category   Mmi
 * @package    Mmi_Form
 * @subpackage Element
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */
class Mmi_Form_Element_Select extends Mmi_Form_Element_Abstract {
	
	/**
	 * Ustawia multiselect
	 * @return Mmi_Form_Element_Select
	 */
	public function setMultiple() {
		$this->_options['multiple'] = 'multiple';
		return $this;
	}

	/**
	 * Buduje pole
	 * @return string
	 */
	public function fetchField() {
		$multiOptions = (isset($this->_options['multiOptions']) && is_array($this->_options['multiOptions'])) ? $this->_options['multiOptions'] : array();
		$value = isset($this->_options['value']) ? $this->_options['value'] : null;
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
		$selected = '';
		if (is_array($value) && in_array($key, $value)) {
			$selected = ' selected="selected"';
		} elseif ($value == $key && !is_null($value)) {
			$selected = ' selected="selected"';
		}
		return $selected;
	}

}
