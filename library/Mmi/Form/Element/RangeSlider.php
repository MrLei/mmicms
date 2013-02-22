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


	public function fetchField() {
		$min = isset($this->_options['min']) ? $this->_options['min'] : 0;
		$max = isset($this->_options['max']) ? $this->_options['max'] : 100;
		$step = isset($this->_options['step']) ? $this->_options['step'] : 1;
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
		$view = Mmi_View::getInstance();
		$view->headScript()->prependFile($view->baseUrl . '/library/js/jquery/jquery.js');
		$view->headScript()->appendFile($view->baseUrl . '/library/js/jquery/ui.js');
		$view->headScript()->appendScript('
			$(document).ready(function() {
				$(\'#' . $this->id . 'Slider\').slider({range: true, \'values\': ' . json_encode($value) . ', \'min\': ' . $min . ',\'max\': ' . $max . ', '.(($step)? '\'step\' : '.$step.' ,' : '').'
					slide: function(event, ui) { $(\'#' . $this->id . '_min\').val(ui.values[0]); $(\'#' . $this->id . '_min\').trigger(\'change\');
						$(\'#' . $this->id . '_max\').val(ui.values[1]); $(\'#' . $this->id . '_max\').trigger(\'change\'); }
				});
				$(\'#' . $this->id . 'Slider > a:first\').addClass(\'ui-slider-handle-min\');
				$(\'#' . $this->id . 'Slider > a:last\').mousedown(function () {
					var vMin = $(\'#' . $this->id . 'Slider\').slider("values", 0);
					var vMax = $(\'#' . $this->id . 'Slider\').slider("values", 1);
					var vStep = '.intval($step).';
					if (vMin == vMax && vStep > 0) {
						$(\'#' . $this->id . 'Slider\').slider("values", 1, vMax + vStep);
					}
				});
			});
		');
		$html = '<input class="sliderField" type="hidden" id="'.$this->id.'_min" name="'.$this->getName().'[]" value="'.$value[0].'" />';
		$html .= '<input class="sliderField" type="hidden" id="'.$this->id.'_max" name="'.$this->getName().'[]" value="'.$value[1].'" />';
		$html .= '<p class="slider range-slider"><span class="slider" id="' . $this->id . 'Slider"></span><span class="sliderFrom">' . number_format($min, 0, ',', ' ') . '</span><span class="sliderTo">' . number_format($max, 0, ',', ' ') . '</span></p>';
		return $html;
	}

}