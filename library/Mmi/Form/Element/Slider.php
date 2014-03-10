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
class Mmi_Form_Element_Slider extends Mmi_Form_Element_Text {
	
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
				$(\'#' . $this->id . '_label span.max\').text(\''.$this->value.'\');
				$(\'#' . $this->id . 'Slider\').slider({\'value\': ' . $this->value . ', \'min\': ' . $min . ',\'max\': ' . $max . ', '.(($step)? '\'step\' : '.$step.' ,' : '').' slide: function(event, ui) {
						$(\'#' . $this->id . '\').val(ui.value); $(\'#' . $this->id . '\').trigger(\'change\'); 
						$(\'#' . $this->id . '_label span.max\').text(ui.value);
					}
				});
			});
		');
		$html = '<input class="sliderField" ';
		$html .= 'type="hidden" ' . $this->_getHtmlOptions() . '/><p class="slider"><span class="slider" id="' . $this->id . 'Slider"></span><span class="sliderFrom">' . number_format($min, 0, ',', ' ') . '</span><span class="sliderTo">' . number_format($max, 0, ',', ' ') . '</span></p>';
		return $html;
	}

}