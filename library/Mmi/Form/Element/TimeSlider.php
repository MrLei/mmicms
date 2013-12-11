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
		$view->headScript()->appendScript('
			$(document).ready(function() {
				$(\'#' . $this->id . 'Slider\').slider({range: "min", \'value\': ' . $this->value . ', \'min\': ' . $min . ',\'max\': ' . $max . ', '.(($step)? '\'step\' : '.$step.' ,' : '').' slide: function(event, ui) {
						$(\'#' . $this->id . '_container .sliderTo\').css(\'display\', \'none\');
						$(\'#' . $this->id . '\').val(ui.value); $(\'#' . $this->id . '\').trigger(\'change\');
						var fl = $(\'#' . $this->id . '_container .float-label\'),
							diff =	parseInt($(fl).attr(\'data-info\')) + (10 - parseInt(parseInt($(fl).parent()[0].style.width)/10))*-1;
						$(fl).text(ui.value+\' h\').css(\'right\', diff+\'px\');
					}
				});
				$(\'#' . $this->id . '_container div.ui-slider-range\').html(\'<div class="float-label"></div>\');
				$(\'#' . $this->id . '_container .float-label\').attr(\'data-info\', $(\'#' . $this->id . '_container .float-label\').css(\'right\'));
			});
		');
		$html = '<input class="sliderField" ';
		$html .= 'type="hidden" ' . $this->_getHtmlOptions() . '/><p class="slider"><span class="slider" id="' . $this->id . 'Slider"></span><span class="sliderTo">' . number_format($max, 0, ',', ' ') . ' h</span></p>';
		return $html;
	}
//flpar.substring(flpar.indexOf(\':\')+1, flpar.indexOf(\'%\')
}