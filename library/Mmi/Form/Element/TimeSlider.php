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
 * Mmi/Form/Element/Slider.php
 * @category   Mmi
 * @package    Mmi_Form
 * @subpackage Element
 * @copyright  Copyright (c) 2010 HQSoft Mariusz Miłejko (http://www.hqsoft.pl)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    $Id$
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */

/**
 * Klasa elementu slidera (suwaka)
 * @category   Mmi
 * @package    Mmi_Form
 * @subpackage Element
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */
class Mmi_Form_Element_TimeSlider extends Mmi_Form_Element_Text {

	/**
	 * Buduje pole
	 * @return string
	 */
	public function fetchField() {
		$min = isset($this->_options['min']) ? $this->_options['min'] : 0;
		$max = isset($this->_options['max']) ? $this->_options['max'] : 100;
		$step = isset($this->_options['step']) ? $this->_options['step'] : 1;
		if (!$this->value) {
			$this->value = $max;
		}
		unset($this->_options['min']);
		unset($this->_options['max']);
		unset($this->_options['step']);
		$view = Mmi_Controller_Front::getInstance()->getView();
		$view->headScript()->prependFile($view->baseUrl . '/library/js/jquery/jquery.js');
		$view->headScript()->appendFile($view->baseUrl . '/library/js/jquery/ui.js');
		$view->headScript()->appendFile($view->baseUrl . '/library/js/form.js');

		$html = '<input class="sliderField" type="hidden" ' . $this->_getHtmlOptions() . '/>'
			.'<p class="slider"><span class="slider js-time-slider" id="' . $this->id . 'Slider" '
			.'data-value="' . $this->value . '" data-min="' . $min . '" data-max="' . $max . '" '
			.'data-step="' . (($step)? $step : '') . '"></span><span class="sliderTo">'
			.number_format($max, 0, ',', ' ') . ' h</span></p>';
		return $html;
	}

	/**
	 * Ustawia minimum
	 * @param int $min
	 * @return Mmi_Form_Element_TimeSlider
	 */
	public function setMinimal($min) {
		$this->_options['min'] = intval($min);
		return $this;
	}

	/**
	 * Ustawia maksimum
	 * @param int $max
	 * @return Mmi_Form_Element_TimeSlider
	 */
	public function setMaximal($max) {
		$this->_options['max'] = intval($max);
		return $this;
	}

	/**
	 * Ustawia krok
	 * @param int $step
	 * @return Mmi_Form_Element_TimeSlider
	 */
	public function setStep($step) {
		$this->_options['step'] = intval($step);
		return $this;
	}

}