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
 * Mmi/Form/Element/RangeTimeSlider.php
 * @category   Mmi
 * @package    Mmi_Form
 * @subpackage Element
 * @copyright  Copyright (c) 2010 HQSoft Mariusz Miłejko (http://www.hqsoft.pl)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    $Id$
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */

/**
 * Klasa elementu range time slidera (suwaka dwustronnego) do dostosowywania czasu
 * @category   Mmi
 * @package    Mmi_Form
 * @subpackage Element
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */
class Mmi_Form_Element_RangeTimeSlider extends Mmi_Form_Element_Abstract {
	
	/**
	 * Ustawia minimalną wartość
	 * @param string $min
	 * @return Mmi_Form_Element_RangeTimeSlider
	 */
	public function setMinimal($min) {
		$this->_options['min'] = $min;
		return $this;
	}
	
	/**
	 * Ustawia maksymalną wartość
	 * @param string $max
	 * @return Mmi_Form_Element_RangeTimeSlider
	 */
	public function setMaximal($max) {
		$this->_options['max'] = $max;
		return $this;
	}
	
	/**
	 * Ustawia krok slidera
	 * @param string $step
	 * @return Mmi_Form_Element_RangeTimeSlider
	 */
	public function setStep($step) {
		$this->_options['step'] = $step;
		return $this;
	}

	/**
	 * Buduje pole
	 * @return string
	 */
	public function fetchField() {
		$min = 0;
		$max = 1440;
		$step = isset($this->_options['step']) ? $this->_options['step'] : 15;
		$value = array($min, $max);
		unset($this->_options['min']);
		unset($this->_options['max']);
		unset($this->_options['step']);
		$view = Mmi_Controller_Front::getInstance()->getView();
		$view->headScript()->prependFile($view->baseUrl . '/library/js/jquery/jquery.js');
		$view->headScript()->appendFile($view->baseUrl . '/library/js/jquery/ui.js');
		$view->headScript()->appendFile($view->baseUrl . '/library/js/form.js');

		$html = '<input class="sliderField" type="hidden" id="'.$this->id.'_min" name="'.$this->getName().'[]" value="'.$value[0].'" />';
		$html .= '<input class="sliderField" type="hidden" id="'.$this->id.'_max" name="'.$this->getName().'[]" value="'.$value[1].'" />';
		$html .= '<p class="slider range-slider"><span class="slider js-rangetime-slider" id="' . $this->id . 'Slider" '
				.'data-values="[' . $min . ',' . $max . ']" data-min="' . $min . '" data-max="' . $max . '" '
				.'data-step="' . (($step)? $step : '') . '"></span><span class="sliderFrom min">';
		$html .= number_format($min, 0, ',', ' ') . '</span><span class="sliderTo max">' . number_format($max, 0, ',', ' ') . '</span></p>';
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
		if (isset($this->_options['id'])) {
			$forHtml = ' id="' . $this->_options['id'] . '_label"';
		} else {
			$forHtml = '';
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
		return '<label' . $forHtml . $requiredClass . '>' . $label . $this->_options['labelPostfix'] . $required . '</label>';
	}

}