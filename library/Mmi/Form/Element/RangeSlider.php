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
 * Mmi/Form/Element/RangeSlider.php
 * @category   Mmi
 * @package    Mmi_Form
 * @subpackage Element
 * @copyright  Copyright (c) 2010 HQSoft Mariusz Miłejko (http://www.hqsoft.pl)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    $Id$
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */

/**
 * Klasa elementu range slidera (suwaka dwustronnego)
 * @category   Mmi
 * @package    Mmi_Form
 * @subpackage Element
 * @license    http://www.hqsoft.pl/new-bsd     New BSD License
 */
class Mmi_Form_Element_RangeSlider extends Mmi_Form_Element_Abstract {

	/**
	 * Buduje pole
	 * @return string
	 */
	public function fetchField() {
		$min = (int) (isset($this->_options['min']) ? $this->_options['min'] : 0);
		$max = (int) (isset($this->_options['max']) ? $this->_options['max'] : 100);
		$step = (int) (isset($this->_options['step']) ? $this->_options['step'] : 1);
		$value = array($min, $max);
		if (is_array($this->value)) {
			if (count($this->value) == 1) {
				$value = array($this->value[0], $max);
			} elseif (count($this->value) >= 2) {
				$value = $this->value;
			}
		}
		unset($this->_options['min']);
		unset($this->_options['max']);
		unset($this->_options['step']);
		$view = Mmi_Controller_Front::getInstance()->getView();
		$view->headScript()->prependFile($view->baseUrl . '/library/js/jquery/jquery.js');
		$view->headScript()->appendFile($view->baseUrl . '/library/js/jquery/ui.js');
		$view->headScript()->appendFile($view->baseUrl . '/library/js/form.js');

		$html = '<input class="sliderField" type="hidden" id="'.$this->id.'_min" name="'.$this->getName().'[]" value="'.$value[0].'" />';
		$html .= '<input class="sliderField" type="hidden" id="'.$this->id.'_max" name="'.$this->getName().'[]" value="'.$value[1].'" />';
		$html .= '<p class="slider range-slider"><span class="slider js-range-slider" id="' . $this->id . 'Slider" '
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
		return '<label' . $forHtml . $requiredClass . '>' . $label . $this->_labelPostfix . $required . '</label>';
	}

}