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
 * Mmi/Form/Element/MultiCheckbox.php
 * @category   Mmi
 * @package    \Mmi\Form
 * @subpackage Element
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    1.0.0
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */
/**
 * Klasa elementu wielokrotnego checkboxa (wybór wielokrotny)
 * @category   Mmi
 * @package    \Mmi\Form
 * @subpackage Element
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

namespace Mmi\Form\Element;

class MultiCheckbox extends ElementAbstract {

	/**
	 * Ustawia klasy dla poszczególnych labelek
	 * @param array $class - tablica $key => $class
	 * @return \Mmi\Form\Element\MultiCheckbox
	 */
	public function setLabelClass(array $class) {
		$this->_options['labelClass'] = $class;
		return $this;
	}

	/**
	 * Buduje pole
	 * @return string
	 */
	public function fetchField() {
		$baseId = $this->_options['id'];
		$multiOptions = isset($this->_options['multiOptions']) ? $this->_options['multiOptions'] : array();
		$labelClass = isset($this->_options['labelClass']) ? $this->_options['labelClass'] : array();
		$values = isset($this->_options['value']) ? $this->_options['value'] : null;

		unset($this->_options['value']);
		$html = '<ul id="' . $this->id . '_list">';
		$this->_options['name'] = $this->_options['name'] . '[]';
		foreach ($multiOptions as $key => $caption) {
			unset($this->_options['checked']);
			if (!is_array($values)) {
				$values = array($values);
			}
			if (!empty($values) && in_array($key, $values)) {
				$this->_options['checked'] = 'checked';
			}
			$f = new \Mmi\Filter\Url();
			$this->_options['id'] = $baseId . '_' . $f->filter($key);
			$this->_options['value'] = $key;

			$classTag = "";
			foreach ($labelClass as $labelId => $className) {
				if ($labelId == $key) {
					$classTag .= 'class="' . $className . '" ';
				}
			}

			if (strpos($key, ':divide') !== false) {
				$html .= '<li class="divide"></li>';
			} elseif (strpos($key, ':disabled') !== false) {
				$this->_options['value'] = '';
				$this->_options['disabled'] = 'disabled';
				$html .= '<li class="disabled" id="' . $this->_options['id'] . '_item' . '">
					<input type="checkbox" ' . $this->_getHtmlOptions() . '/>
					<label ' . $classTag . 'for="' . $this->_options['id'] . '">' . $caption . '</label>
				</li>';
			} else {
				unset($this->_options['disabled']);
				$html .= '<li id="' . $this->_options['id'] . '_item' . '">
					<input type="checkbox" ' . $this->_getHtmlOptions() . '/>
					<label ' . $classTag . 'for="' . $this->_options['id'] . '">' . $caption . '</label>
				</li>';
			}
		}
		$html .= '</ul>';
		$this->_options['id'] = $baseId;
		return $html;
	}

	/**
	 * Buduje etykietę pola
	 * @return string
	 */
	public function fetchLabel() {
		if (!isset($this->_options['label'])) {
			return;
		}
		if (isset($this->_options['required']) && $this->_options['required'] && isset($this->_options['markRequired']) && $this->_options['markRequired']) {
			$requiredClass = ' class="required"';
			$required = '<span class="required">' . $this->_requiredAsterisk . '</span>';
		} else {
			$requiredClass = '';
			$required = '';
		}
		if ($this->_translatorEnabled) {
			$label = $this->getTranslate()->_($this->_options['label']);
		} else {
			$label = $this->_options['label'];
		}
		return '<label' . $requiredClass . '>' . $label . $this->_options['labelPostfix'] . $required . '</label>';
	}

}
