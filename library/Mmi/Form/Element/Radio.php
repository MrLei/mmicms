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
 * Mmi/Form/Element/Radio.php
 * @category   Mmi
 * @package    Mmi_Form
 * @subpackage Element
 * @copyright  Copyright (c) 2010 HQSoft Mariusz Miłejko (http://www.hqsoft.pl)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    $Id$
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */

/**
 * Klasa elementu opcji (select)
 * @category   Mmi
 * @package    Mmi_Form
 * @subpackage Element
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */
class Mmi_Form_Element_Radio extends Mmi_Form_Element_Abstract {
	
	/**
	 * Ustawia klasy dla poszczególnych labelek
	 * @param array $class - tablica $key => $class
	 * @return Mmi_Form_Element_Radio
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
		$value = isset($this->_options['value']) ? $this->_options['value'] : null;

		unset($this->_options['value']);
		$html = '<ul id="' . $this->id .'_list">';
		foreach ($multiOptions as $key => $caption) {
			unset($this->_options['checked']);
			if ($value == $key && !is_null($value)) {
				$this->_options['checked'] = 'checked';
			}
			$liClass = '';
			if (mb_stripos($key, ':disabled')) {
				$key = mb_strstr($key, ':disabled', true, 'utf-8');
				$this->_options['disabled'] = '';
				$this->_options['value'] = '';
				$liClass = 'disabled';
			} else {
				unset($this->_options['disabled']);
				$this->_options['value'] = $key;
			}
			$f = new Mmi_Filter_Url();
			$this->_options['id'] = $baseId . '_' . $f->filter($key);
			$classTag = "";
			foreach ($labelClass as $labelId => $className) {
				if($labelId == $key) {
					$classTag .= 'class="' . $className . '" ';
				}
			}
			$html .= '<li id="' . $this->_options['id'] . '_item" class="'. $liClass .'">
				<input type="radio" ' . $this->_getHtmlOptions() . '/>
				<label ' . $classTag . 'for="' . $this->_options['id'] . '">'. $caption .'</label>
			</li>';
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
