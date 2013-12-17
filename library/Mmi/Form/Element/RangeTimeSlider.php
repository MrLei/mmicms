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
		$view->headScript()->appendScript('
			$(document).ready(function() {
				$(\'#' . $this->id . '_container span.min\').text(timeDecode(\''.$value[0].'\'));
				$(\'#' . $this->id . '_container span.max\').text(timeDecode(\''.$value[1].'\'));
				$(\'#' . $this->id . 'Slider\').slider({range: true, \'values\': ' . json_encode($value) . ', \'min\': ' . $min . ',\'max\': ' . $max . ', '.(($step)? '\'step\' : '.$step.' ,' : '').'
					slide: function(event, ui) {
						$(\'#' . $this->id . '_min\').val(ui.values[0]); $(\'#' . $this->id . '_min\').trigger(\'change\');
						$(\'#' . $this->id . '_max\').val(ui.values[1]); $(\'#' . $this->id . '_max\').trigger(\'change\');
						$(\'#' . $this->id . '_container span.min\').text(timeDecode(ui.values[0]));
						$(\'#' . $this->id . '_container span.max\').text(timeDecode(ui.values[1]));
					}
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
		$html .= '<p class="slider range-slider"><span class="slider" id="' . $this->id . 'Slider"></span><span class="sliderFrom min">' . number_format($min, 0, ',', ' ') . '</span><span class="sliderTo max">' . number_format($max, 0, ',', ' ') . '</span></p>';
		return $html;
	}
// <![CDATA[
//$(document).ready(function() {
//	$('#faset_originFlightTime2_label span.min').text('0');
//	$('#faset_originFlightTime2_label span.max').text('96');
//	$('#faset_originFlightTime2Slider').slider({range: true, 'values': [0,96], 'min': 0,'max': 96, 'step' : 1 ,
//		slide: function(event, ui) {
//			$('#faset_originFlightTime2_min').val(ui.values[0]); $('#faset_originFlightTime2_min').trigger('change');
//			$('#faset_originFlightTime2_max').val(ui.values[1]); $('#faset_originFlightTime2_max').trigger('change');
//			$('#faset_originFlightTime2_container span.min').text(ui.values[0]);
//			$('#faset_originFlightTime2_container span.max').text(ui.values[1]);
//		}
//	});
//	$('#faset_originFlightTime2Slider > a:first').addClass('ui-slider-handle-min');
//	$('#faset_originFlightTime2Slider > a:last').mousedown(function () {
//		var vMin = $('#faset_originFlightTime2Slider').slider("values", 0);
//		var vMax = $('#faset_originFlightTime2Slider').slider("values", 1);
//		var vStep = 1;
//		if (vMin == vMax && vStep > 0) {
//			$('#faset_originFlightTime2Slider').slider("values", 1, vMax + vStep);
//		}
//	});
//});
// ]]>
	
//	$(".slider-range").slider({
//        range: true,
//        min: 0,
//        max: 1440,
//        step: 15,
//        slide: function(e, ui) {
//            var hours = Math.floor(ui.value / 60);
//            var minutes = ui.value - (hours * 60);
//
//            if(hours.length == 1) hours = '0' + hours;
//            if(minutes.length == 1) minutes = '0' + minutes;
//
//            $('#something').html(hours+':'+minutes);
//        }
//    });
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